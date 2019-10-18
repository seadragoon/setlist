<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
		
		$artists = Artist::orderBy('artist_id', 'asc')->get();
		
		$params = array();
		$params['artists'] = $artists;
		return view('aggregate/index')->with('params', $params);
	}
	
	// show
	public function show($artist_id)
	{
		// セットリストから特定のアーティストが演奏した回数をカウントして降順リストにして返却
		
		// セットリスト配列
		$setlists = Setlist::where('artist_id', $artist_id)->get();
		
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
			
			$result[$songId]['song_id'] = $songId;
			$result[$songId]['name'] = $song->name;
		}
		
		// 回数でソート
		usort($result, function ($a, $b) {
			return $a['count'] < $b['count'] ? 1 : -1;
		});
		
		// アーティスト情報を取得
		$artist = Artist::where('artist_id', $artist_id)->first();
		
		$params = array();
		$params['artist'] = $artist;
		$params['result'] = $result;
		return view('aggregate/show')->with('params', $params);
	}
}
