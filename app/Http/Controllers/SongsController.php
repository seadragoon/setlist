<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use App\User;
use App\Artist;
use App\Song;
use App\Event;
use App\Setlist;
use App\SetlistSong;
use App\Util\TimeManager;
use App\Util\ConstantManager;

class SongsController extends Controller
{
    // index
	public function index()
	{
		return redirect('/');
		//$songs = Song::orderBy('song_id', 'asc')->get();
		//return view('songs/index')->with('songs', $songs);
	}
	
	// show
	public function show($song_id)
	{
		$song = Song::where('song_id', $song_id)->first();
		if (empty($song)){
            return abort('404');
		}
		$artist = Artist::where('artist_id', $song->artist_id)->first();
		
		// 最終編集者を取得
		$lastEditUser = User::where('id', $song->edit_user_id)->first();
		
		// 対象の歌をセトリに含むイベントを検索
		$eventDataList = array();
		$count = 0;

		$setlistSongs = SetlistSong::where('song_id', $song_id)->get();
		foreach ($setlistSongs as $setlistSong)
		{
			// セットリストIDとアーティストIDの等しいセットリストを取得
			// ※別アーティストによるカバーはここではリストに含めない
			$setlist = Setlist::where('setlist_id', $setlistSong->setlist_id)->where('artist_id', $song->artist_id)->first();
			
			if (!empty($setlist)) {
				// イベントIDの等しいイベントを取得
				$event = Event::where('event_id', $setlist->event_id)->first();

				// カウント加算
				$count++;

				// イベントデータを配列に詰める
				array_push($eventDataList, $event);
			}
		}

		// 重複削除
		$eventDataList = array_unique($eventDataList);
		
		// 日付でソート
		usort($eventDataList, function ($a, $b) {
			return $a->datetime < $b->datetime ? 1 : -1;
		});
		
		$param = array();
		$param['artist'] = $artist;
		$param['song'] = $song;
		$param['count'] = $count;
		$param['lastEditUserName'] = empty($lastEditUser) ? '管理者' : $lastEditUser->screen_name;
		$param['lastEditTime'] = TimeManager::convert_to_fuzzy_time($artist->updated_at);
		$param['eventDataList'] = $eventDataList;
		return view('songs/show')->with('param', $param);
	}
	
	// edit
	public function edit($song_id)
	{
		$song = Song::where('song_id', $song_id)->first();

		$artistMasters = Artist::get();
		
		$artist = $artistMasters->where('artist_id', $song->artist_id)->first();

		$params = array();
		$params['song'] = $song;
		$params['artist'] = $artist;
		$params['artistMasters'] = $artistMasters;
		return view('songs/edit')->with('params', $params);
	}
	
	
	// update
	public function update(Request $request, $song_id)
	{
		$data = $request->all();

		// 値の検証
		$rules = [
			'song_name'						=>'string|max:100',				// 楽曲名
			'artist_name'					=>'string|max:100',				// アーティスト名
		];

		// バリデーションデータ作成
		$validation = \Validator::make($data, $rules);

		// アーティストマスタ(配列)
		$artistMasters = Artist::get()->toArray();

		$targetIndex = array_search($data['artist_name'], array_column($artistMasters, 'name'));
		if ($targetIndex === false){
			// 含まれなかったらエラー追加
			$validation->errors()->add('artist_not_found', '指定された名前のアーティストは存在しません');
		}

		// バリデーション確認
		if (!empty($validation->errors()->all()))
		{
			return redirect()->back()->withErrors($validation->errors())->withInput();
		}
		
		// 楽曲データ取得
		$song = Song::where('song_id', $song_id)->first();
		// アーティスト情報
		$artsit = $artistMasters[$targetIndex];

		// データ保存
		$song->artist_id = $artsit['artist_id'];
		$song->name = $data['song_name'];
		if (!empty(Auth::user())) {
			$song->edit_user_id = Auth::user()->id;
		}
		$song->save();
		return redirect()->route('songs.show', $song_id);
	}
	
	// destroy
	public function destroy($song_id)
	{
		$song = Song::where('song_id', $song_id)->first();
		$song->delete();
		return redirect()->route('artists.show', $song->artist_id);
	}
	
	// add
	public function add(Request $request)
	{
		$artist = Artist::where('artist_id', $request['artist_id'])->first();
		
		$param = array();
		$param['artist'] = $artist;
		$param['song'] = new Song();
		
		//echo '<pre>' . var_export($param, true) . '</pre>';
		
		return view('songs/add')->with('param', $param);
	}
	
	// store
	public function store(Request $request)
	{
		//echo '<pre>' . var_export($request, true) . '</pre>';
		
		$song = new Song();
		$song->fill($request->all());
		if (!empty(Auth::user())) {
			$song->edit_user_id = Auth::user()->id;
		}
		$song->save();
		return redirect()->route('artists.show', $song->artist_id);
	}
	
	/**
	 * 検索アクション
	 */
	public function search(Request $request)
	{
		$keyword = $request->input('keyword');
		$songs = array();
		
		if (!empty($keyword)) {
			// 楽曲名部分一致で検索
			$songs = Song::where('name', 'LIKE', "%$keyword%")->orderby('name', 'asc')->paginate(ConstantManager::PerPage);

			// \Log::debug(var_export($songs->getCollection()->toArray(), true));
			
			// 対応するアーティスト名を取得
			$artists = Artist::whereIn('artist_id', array_unique(array_column($songs->getCollection()->toArray(), 'artist_id')))->get();
			
			foreach ($songs as $song) {
				$target = $artists->where('artist_id', $song->artist_id)->first();
				
				$song->artist_name = $target->name;
			}
		}
		
		$params = array();
		$params['keyword'] = $keyword;
		$params['result'] = $songs;
		return view('songs/search')->with('params', $params);
	}
}
