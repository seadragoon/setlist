<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Datetime;

use App\Artist;
use App\Song;
use App\Event;
use App\Setlist;
use App\SetlistSong;

class AggregateController extends Controller
{
    // index
	public function index()
	{
		// indexはアーティストリストを表示して個別ページへの導線だけのページにしても良い
		
		$artists = Artist::orderBy('name', 'asc')->get();
		
		$params = array();
		$params['artists'] = $artists;
		return view('aggregate/index')->with('params', $params);
	}
	
	// show
	public function show(Request $request, $artist_id)
	{
		// 対象アーティスト情報を取得
		$artist = Artist::where('artist_id', $artist_id)->first();
		if (empty($artist)){
            return abort('404');
		}

		// 日付データを準備
		$date_from = empty($request->input('date_from')) ? '1970-1-1' : $request->input('date_from');
		$date_to = empty($request->input('date_to')) ? '2099-1-1' : $request->input('date_to');
		
		$fromDate = new Datetime($date_from);
		$toDate = new Datetime($date_to);
		$toDate->setTime(23, 59, 59);	// その日の最後に設定
		
		// セットリストから特定のアーティストが演奏した回数をカウントして降順リストにして返却
		
		// イベントリスト
		$events = Event::whereBetween('datetime', [$fromDate, $toDate])->get();
		
		// セットリスト（抽出したイベントIDを含む、かつ、対象のアーティストIDのセットリスト）
		$setlistsArray = Setlist::whereIn('event_id', array_column($events->toArray(), 'event_id'))
						->where('artist_id', $artist_id)->get()->toArray();
		
		// 演奏日付を紐づけ
		foreach ($setlistsArray as $index => $setlist)
		{
			$targetEvent = $events->where('event_id', $setlist['event_id'])->first();

			$setlistsArray[$index]['datetime'] = $targetEvent->datetime;
		}
		
		// セトリ配列を日付でソート
		usort($setlistsArray, function ($a, $b) {
			return new Datetime($b['datetime']) < new Datetime($a['datetime']) ? 1 : -1;
		});
		
		// セトリ曲データでセトリIDの等しいものを全部取得してsong_idで集計する
		$result = array();
		foreach ($setlistsArray as $index => $setlist)
		{
			// 現在のループのセットリストの日付
			$thisLoopDate = new Datetime($setlist['datetime']);

			// セトリIDが等しいセトリ曲データを全て取得
			$setlistSongs = SetlistSong::where('setlist_id', $setlist['setlist_id'])->get();
			foreach ($setlistSongs as $setlistSong)
			{
				// 回数集計
				$songId = $setlistSong->song_id;
				if (empty($result[$songId]['count'])) {
					$result[$songId]['count'] = 0;
				}
				$result[$songId]['count'] += 1;

				// 初演奏日付
				if (empty($result[$songId]['first_date'])) {
					$result[$songId]['first_date'] = $setlist['datetime'];
					$result[$songId]['first_date_index'] = $index;
				} else {
					$preliminaryDate = new Datetime($result[$songId]['first_date']);
					if ($thisLoopDate < $preliminaryDate) {
						$result[$songId]['first_date'] = $setlist['datetime'];
						$result[$songId]['first_date_index'] = $index;
					}
				}

				// 最終演奏日付
				if (empty($result[$songId]['last_date'])) {
					$result[$songId]['last_date'] = $setlist['datetime'];
				} else {
					$preliminaryDate = new Datetime($result[$songId]['last_date']);
					if ($preliminaryDate < $thisLoopDate) {
						$result[$songId]['last_date'] = $setlist['datetime'];
					}
				}
			}
		}

		// セトリ配列の個数
		$setlistCount = count($setlistsArray);
		
		// 曲名を紐づけ、自分自身の楽曲かどうか判定
		foreach ($result as $songId => $value) {
			$song = Song::where('song_id', $songId)->first();

			$songName = $song->name;
			if ($song->artist_id != $artist_id) {
				$songArtist = Artist::where('artist_id', $song->artist_id)->first();
				$songName .= '(' . $songArtist->name . ')';

				$result[$songId]['is_own'] = false;
			} else {
				$result[$songId]['is_own'] = true;
			}
			
			$result[$songId]['song_id'] = $songId;
			$result[$songId]['name'] = $songName;
			
			$result[$songId]['first_date_short'] = (new Datetime($result[$songId]['first_date']))->format('Y-n-j'); // Y-m-d形式に整形
			$result[$songId]['last_date_short'] = (new Datetime($result[$songId]['last_date']))->format('Y-n-j'); // Y-m-d形式に整形

			$result[$songId]['rate'] = round($result[$songId]['count'] / ($setlistCount - $result[$songId]['first_date_index']) * 100, 1);
		}
		
		// 0回のリストも作成するためにアーティストの楽曲もすべて取得する
		$artistSongs = Song::where('artist_id', $artist->artist_id)->orderby('name', 'asc')->get();
		foreach ($artistSongs as $song) {
			$songId = $song->song_id;
			if (empty($result[$songId])) {
				$result[$songId] = array();
				$result[$songId]['count'] = 0;
				$result[$songId]['song_id'] = $songId;
				$result[$songId]['name'] = $song->name;
				$result[$songId]['is_own'] = true;
				$result[$songId]['first_date'] = null;
				$result[$songId]['last_date'] = null;
				$result[$songId]['first_date_short'] = null;
				$result[$songId]['last_date_short'] = null;
				$result[$songId]['rate'] = 0;
			}
		}
		
		// 回数でソート
		usort($result, function ($a, $b) {
			return $a['count'] < $b['count'] ? 1 : -1;
		});
		
		$params = array();
		$params['date_from'] = $request->input('date_from');
		$params['date_to'] = $request->input('date_to');
		$params['artist'] = $artist;
		$params['live_count'] = $setlistCount;
		$params['result'] = $result;
		return view('aggregate/show')->with('params', $params);
	}
}
