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
		$setlists = Setlist::whereIn('event_id', array_column($events->toArray(), 'event_id'))
						->where('artist_id', $artist_id)->get();
		
		// セトリ曲データでセトリIDの等しいものを全部取得してsong_idで集計する
		$result = array();
		foreach ($setlists as $setlist)
		{
			// セトリIDが等しいセトリ曲データを全て取得
			$setlistSongs = SetlistSong::where('setlist_id', $setlist->setlist_id)->get();
			foreach ($setlistSongs as $setlistSong)
			{
				$songId = $setlistSong->song_id;
				if (empty($result[$songId]['count'])) {
					$result[$songId]['count'] = 0;
				}
				$result[$songId]['count'] += 1;
			}
		}
		
		// 曲名を紐づけ
		foreach ($result as $songId => $value) {
			$song = Song::where('song_id', $songId)->first();

			$songName = $song->name;
			if ($song->artist_id != $artist_id) {
				$songArtist = Artist::where('artist_id', $song->artist_id)->first();
				$songName .= '(' . $songArtist->name . ')';
			}
			
			$result[$songId]['song_id'] = $songId;
			$result[$songId]['name'] = $songName;
		}
		
		// 回数でソート
		usort($result, function ($a, $b) {
			return $a['count'] < $b['count'] ? 1 : -1;
		});
		
		$params = array();
		$params['date_from'] = $request->input('date_from');
		$params['date_to'] = $request->input('date_to');
		$params['artist'] = $artist;
		$params['result'] = $result;
		return view('aggregate/show')->with('params', $params);
	}
}
