<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Datetime;
use Exception;

use App\Artist;
use App\Song;
use App\Event;
use App\Setlist;
use App\SetlistGroup;
use App\SetlistSong;

use App\Http\requests;
use Illuminate\Support\Facades\DB;

class EventsController extends Controller
{
	public function index()
	{
		return redirect('/');
		//$tasks = Task::orderBy('updated_at', 'desc')->get();
		//return view('tasks/index')->with('tasks', $tasks);
	}
	
	public function show($event_id)
	{
		//TODO : 複数アーティストのデータを登録すると複数取れるが、ひとまず一旦最初に見つかったもので実装
		$setlist = Setlist::where('event_id', $event_id)->first();
		
		$songDataList = array();
		
		// 曲マスタリストを全件取得
		$songMasters = Song::get();
		// アーティストマスタを全件取得
		$artistMasters = Artist::get();
		
		// セトリグループを取得
		$setlistGroups = SetlistGroup::where('setlist_id', $setlist->setlist_id)->get();
		foreach ($setlistGroups as $group) {
			// セトリ曲一覧
			$setlistSongs = SetlistSong::where('setlist_id', $setlist->setlist_id)->where('setlist_group_seq', $group->setlist_group_seq)->get();
			
			// セトリグループの種類ごとに曲名リストを作成する
			foreach ($setlistSongs as $value)
			{
				$master = $songMasters->where('song_id', $value->song_id)->first();
				
				// コラボアーティストIDから名前を取得
				$collaboArtistIds = explode(',', $value['collabo_artist_ids']);
				$collaboArtistNames = array();
				foreach($collaboArtistIds as $artistId){
 					if(empty($artistId)) continue;
					
					$artist = $artistMasters->where('artist_id', $artistId)->first();
					array_push($collaboArtistNames, $artist->name);
				}
				
				$songData = array();
				$songData['seq']				= $value->seq + 1;
				$songData['song_id']			= $master['song_id'];
				$songData['name']				= $master['name'];
				$songData['is_short']			= $value['is_medley'];
				$songData['arrange_type']		= $value['arrange_type'];
				$songData['collabo_artists']	= implode(',', $collaboArtistNames);
				
				$songDataList[$group->setlist_group_seq][$value->seq] = $songData;
			}
		}
		
		$song_list			= empty($songDataList[0]) ? array() : $songDataList[0];		// 通常セトリ
		$encore_song_list	= empty($songDataList[1]) ? array() : $songDataList[1];		// アンコールセトリ
		
		// イベントデータを取得
		$event_data = Event::where('event_id', $event_id)->first();
		
		$param = array();
		$param['event_data'] = $event_data;
		// TODO: 以下は複数アーティスト対応する場合には確認する必要あり
		$param['artist'] = $artistMasters->where('artist_id', $setlist->artist_id)->first();
		$param['song_list'] = $song_list;
		$param['encore_song_list'] = $encore_song_list;
		
		//echo '<pre>' . var_export($param, true) . '</pre>';
		
		return view('events/show')->with('param', $param);
	}
	
	public function create(Request $request)
	{
		$date = empty($request->input('date')) ? new Datetime() : new Datetime($request->input('date'));
		$artist_id = empty($request->input('artist_id')) ? 0 : $request->input('artist_id');
		
		
		$params = array();
		
		// 楽曲をすべて取得 TODO: 他アーティストの楽曲を沢山登録していった場合負荷が掛かり過ぎる恐れがある
		$songMasters = Song::orderby('name', 'asc')->get();
		$params['songMasters'] = $songMasters;
		// アーティストをすべて取得
		$artistMasters = Artist::orderBy('artist_id', 'asc')->get();
		$params['artistMasters'] = $artistMasters;
		
		$artist_name = null;
		if (!empty($artist_id)){
			$artist = Artist::where('artist_id', $artist_id)->first();
			$artist_name = $artist->name;
		}
		$params['artist_name'] = $artist_name;
		
		$params['event_id'] = null;
		$params['event_date'] = $date->format('Y-m-d');
		$params['event_time'] = null;
		$params['event_name'] = null;
		$params['event_venue'] = null;
		$params['event_summary'] = null;
		$params['event_type'] = 0;
		$params['event_tag'] = null;
		$params['songs'] = null;
		$params['encore_songs'] = null;
		
		return view('events/create')->with('params', $params);
	}
	
	public function store(Request $request)
	{
		$data = $request->all();
		//echo '<pre>' . var_export($data, true) . '</pre>';
		
		// 値の検証
		$rules = [
			'event_date'					=>'required|string|max:10',		// 年月日 xxxx-xx-xx
			'event_time'					=>'required|string|max:5',		// 時分 xx:xx
			'artist_name'					=>'required|string|max:100',	// アーティスト名
			'event_name'					=>'required|string|max:100',	// イベント名
			'event_venue'					=>'required|string|max:100',	// 会場名
			'event_summary'					=>'nullable|string|max:100',	// イベント概要
			'event_type'					=>'integer|max:10',				// イベントタイプ
			'event_tag'						=>'nullable|string|max:100',	// イベントタグ
			'songs'							=>'array',						// 通常楽曲配列
			'songs.*'						=>'required|array|min:2',		// 通常楽曲の連想配列
			'songs.*.name'					=>'required|string|max:100',	// 通常楽曲曲名
			'songs.*.is_short'				=>'integer|max:50',				// 通常楽曲ショートかどうか
			'songs.*.arrange_type'			=>'required|integer|max:5',		// 通常楽曲アレンジタイプ
			'songs.*.collabo_artists'		=>'nullable|string|max:100',	// 通常楽曲コラボアーティスト
			'encore_songs'					=>'array',						// アンコール楽曲配列
			'encore_songs.*'				=>'array',						// アンコール楽曲の連想配列
			'encore_songs.*.name'			=>'string|max:100',				// アンコール楽曲曲名
			'encore_songs.*.is_short'		=>'integer|max:50',				// アンコール楽曲ショートかどうか
			'encore_songs.*.arrange_type'	=>'integer|max:5',				// アンコール楽曲アレンジタイプ
			'encore_songs.*.collabo_artists'=>'nullable|string|max:100',	// アンコール楽曲コラボアーティスト
		];
		
		// リストの後ろに曲名が空の要素がある場合は予め弾いておく
		for($i = count($data['songs']) - 1; $i >= 0; $i--)
		{
			if (empty($data['songs'][$i]['name']))
			{
				unset($data['songs'][$i]);
			}
			else
			{
				// 空じゃない要素が来たら終了
				break;
			}
		}
		for($i = count($data['encore_songs']) - 1; $i >= 0; $i--)
		{
			if (empty($data['encore_songs'][$i]['name']))
			{
				unset($data['encore_songs'][$i]);
			}
			else
			{
				// 空じゃない要素が来たら終了
				break;
			}
		}
		
		// バリデーションデータ作成
		$validation = \Validator::make($data, $rules);
		
		// 楽曲マスタを取得
		$songMasters = Song::get()->toArray();
		// アーティストマスタを取得
		$artistMasters = Artist::get()->toArray();
		
		// アーティスト名の確認
		$artist_id = 0;
		$targetIndex = array_search($data['artist_name'], array_column($artistMasters, 'name'));
		if ($targetIndex === false){
			// 含まれなかったらエラー追加
			$validation->errors()->add('artist_name_wrong', '※指定された名前のアーティストは定義されていません');
		} else {
			// 見つかった場合はアーティストIDを保持しておく
			$artist_id = $artistMasters[ $targetIndex ]['artist_id'];
		}
		
		// 楽曲データの確認
		foreach($data['songs'] as $key => $value)
		{
			// 曲名リストがちゃんと定義されているかを確認
			if (array_search($value['name'], array_column($songMasters, 'name')) === false)
			{
				// 含まれなかったらエラー追加
				$validation->errors()->add('songs.'.$key.'.name', '※曲名が入力されていないか、正しくありません');
			}
			// コラボアーティストがちゃんと定義されているかを確認
			$collaboArtistNames = explode(',', $value['collabo_artists']);
			foreach($collaboArtistNames as $artistName){
 				if(empty($artistName)) continue;
				
				$targetIndex = array_search($artistName, array_column($artistMasters, 'name'));
				if ($targetIndex === false){
					// 含まれなかったらエラー追加
					$validation->errors()->add('songs.'.$key.'.collabo_artists', '※指定された名前のコラボアーティストは定義されていません');
 				} else if (!empty($artist_id) && $artistMasters[$targetIndex]['artist_id'] === $artist_id) {
 					// アーティストIDが同一の場合はエラー
					$validation->errors()->add('songs.'.$key.'.collabo_artists', '※指定されたコラボアーティストは自分自身です');
				}
			}
		}
		// アンコール楽曲データの確認
		foreach($data['encore_songs'] as $key => $value)
		{
			// 曲名リストがちゃんと含まれているかを確認
			if (array_search($value['name'], array_column($songMasters, 'name')) === false)
			{
				// 含まれなかったらエラー追加
				$validation->errors()->add('encore_songs.'.$key.'.name', '※曲名が入力されていないか、正しくありません');
			}
			// コラボアーティストがちゃんと定義されているかを確認
			$collaboArtistNames = explode(',', $value['collabo_artists']);
			foreach($collaboArtistNames as $artistName){
 				if(empty($artistName)) continue;
				
				$targetIndex = array_search($artistName, array_column($artistMasters, 'name'));
				if ($targetIndex === false){
					// 含まれなかったらエラー追加
					$validation->errors()->add('encore_songs.'.$key.'.collabo_artists', '※指定された名前のコラボアーティストは定義されていません');
 				} else if (!empty($artist_id) && $artistMasters[$targetIndex]['artist_id'] === $artist_id) {
 					// アーティストIDが同一の場合はエラー
					$validation->errors()->add('encore_songs.'.$key.'.collabo_artists', '※指定されたコラボアーティストは自分自身です');
				}
			}
		}
		
		// バリデーション確認
		if (!empty($validation->errors()->all()))
		{
			\Log::debug("validation error.");
			\Log::debug(var_export($validation->errors(), true));
			return redirect()->back()->withErrors($validation->errors())->withInput();
		}
		
		// バリデーションOK
		//echo '<pre>' . var_export($data, true) . '</pre>';
		\Log::debug(var_export($data, true));
		
		// 編集時と新規作成で処理を分ける(event_idを受け取っているかどうか)
		$event_id = $data['event_id'];
		
		try
		{
			// トランザクション開始
			DB::beginTransaction();
			
			// eventsデータ登録
			$tmpDate = new Datetime($data['event_date']);
			$timelist = explode(':', $data['event_time']);
			$tmpDate->setTime($timelist[0], $timelist[1], 0);
			
			if (empty($event_id)) {
				$event = new Event();
			} else {
				$event = Event::where('event_id', $event_id)->first();
			}
			$event->datetime = $tmpDate;
			$event->name = $data['event_name'];
			$event->venue_name = $data['event_venue'];
			$event->summary = $data['event_summary'];
			$event->tag_text = $data['event_tag'];
			$event->event_type = $data['event_type'];
			$event->save();
			
			// setlistデータ登録
			if (empty($event_id)) {
				$setlist = new Setlist();
				$event_id = empty($event->event_id) ? $event->id : $event->event_id;
			} else {
				$setlist = Setlist::where('event_id', $event_id)->first();
			}
			$setlist->event_id = $event_id;
			$setlist->artist_id = $artist_id;
			$setlist->save();
			
			// setlist_group登録
			$setlist_id = empty($setlist->setlist_id) ? $setlist->id : $setlist->setlist_id;
			
			for($i = 0;$i <= 1;$i++){
				$setlistGroup = SetlistGroup::where('setlist_id', $setlist_id)->where('setlist_group_type', $i)->first();
				if (empty($setlistGroup)) {
					$setlistGroup = new SetlistGroup();
					$setlistGroup->setlist_id = $setlist_id;
				}
				$setlistGroup->setlist_group_seq = $i;
				$setlistGroup->setlist_group_type = $i;
				$setlistGroup->save();
			}
			
			// setlist_songs登録
			SetlistSong::where('setlist_id', $setlist_id)->delete(); // 登録前に削除しておく
			
			$setlistSongs = array();
			foreach($data['songs'] as $key => $value)
			{
				$song_index = array_search($value['name'], array_column($songMasters, 'name'));
				if ($song_index === false) {
					// TODO: 曲名からIDが取れなかった(上で確認してるからありえない)
					echo '<pre>' . var_export($data['songs'], true) . '</pre>';
					throw new Exception();
				}
				$song_id = $songMasters[$song_index]['song_id'];
				
				// コラボアーティストのIDリストを取得
				$collaboArtistNames = explode(',', $value['collabo_artists']);
				$collaboArtistIds = array();
				foreach($collaboArtistNames as $artistName){
 					if(empty($artistName)) continue;
					
					$artist_index = array_search($artistName, array_column($artistMasters, 'name'));
					array_push($collaboArtistIds, $artistMasters[$artist_index]['artist_id']);
				}
				
				$songData = array();
				$songData['setlist_id'] = $setlistGroup->setlist_id;
				$songData['setlist_group_seq'] = 0;
				$songData['seq'] = $key;
				$songData['song_id'] = $song_id;
				$songData['is_medley'] = empty($value['is_short']) ? false : true;
				$songData['collabo_artist_ids'] = implode(",", $collaboArtistIds);
				$songData['arrange_type'] = $value['arrange_type'];
				$songData['created_at'] = new DateTime();
				$songData['updated_at'] = new DateTime();
				
				array_push($setlistSongs, $songData);
			}
			foreach($data['encore_songs'] as $key => $value)
			{
				$song_index = array_search($value['name'], array_column($songMasters, 'name'));
				if ($song_index === false) {
					// TODO: 曲名からIDが取れなかった(上で確認してるからありえない)
					echo '<pre>' . var_export($data['encore_song_names'], true) . '</pre>';
					throw new Exception();
				}
				$song_id = $songMasters[$song_index]['song_id'];
				
				// コラボアーティストのIDリストを取得
				$collaboArtistNames = explode(',', $value['collabo_artists']);
				$collaboArtistIds = array();
				foreach($collaboArtistNames as $artistName){
 					if(empty($artistName)) continue;
					
					$artist_index = array_search($artistName, array_column($artistMasters, 'name'));
					array_push($collaboArtistIds, $artistMasters[$artist_index]['artist_id']);
				}
				
				$songData = array();
				$songData['setlist_id'] = $setlistGroup->setlist_id;
				$songData['setlist_group_seq'] = 1;
				$songData['seq'] = $key;
				$songData['song_id'] = $song_id;
				$songData['is_medley'] = empty($value['is_short']) ? false : true;
				$songData['collabo_artist_ids'] = implode(",", $collaboArtistIds);
				$songData['arrange_type'] = $value['arrange_type'];
				$songData['created_at'] = new DateTime();
				$songData['updated_at'] = new DateTime();
				
				array_push($setlistSongs, $songData);
			}
			// 保存
			SetlistSong::insert($setlistSongs);
			
			// トランザクション終了（コミット）
			DB::commit();
		}
		catch (Exception $ex)
		{
			echo "例外が発生: " . $ex;
			// ロールバック
			DB::rollback();
			
			return;
		}
		
		return redirect()->route('events.show', $setlist->event_id);
	}
	
	public function edit($event_id)
	{
		// イベントデータを取得
		$event_data = Event::where('event_id', $event_id)->first();
		$event_datetime = new Datetime($event_data->datetime);
		
		//TODO : 複数アーティストのデータを登録すると複数取れるが、ひとまず一旦最初に見つかったもので実装
		$setlist = Setlist::where('event_id', $event_id)->first();
		
		// 曲マスタリストを取得
		$songMasters = Song::orderby('name', 'asc')->get();
		// アーティストマスタを取得
		$artistMasters = Artist::orderby('artist_id', 'asc')->get();
		
		$songDataList = array();
		
		// セットリストグループを取得(通常、アンコールなど取得できる)
		$setlistGroups = SetlistGroup::where('setlist_id', $setlist->setlist_id)->get();
		foreach ($setlistGroups as $group) {
			// セトリ曲一覧
			$setlistSongs = SetlistSong::where('setlist_id', $setlist->setlist_id)->where('setlist_group_seq', $group->setlist_group_seq)->get();
			
			// セトリグループの種類ごとに曲名リストを作成する
			foreach ($setlistSongs as $value)
			{
				$master = $songMasters->where('song_id', $value->song_id)->first();
				
				// コラボアーティストIDから名前を取得
				$collaboArtistIds = explode(',', $value['collabo_artist_ids']);
				$collaboArtistNames = array();
				foreach($collaboArtistIds as $artistId){
 					if(empty($artistId)) continue;
					
					$artist = $artistMasters->where('artist_id', $artistId)->first();
					array_push($collaboArtistNames, $artist->name);
				}
				
				$songData = array();
				$songData['name']				= $master['name'];
				$songData['is_short']			= $value['is_medley'];
				$songData['arrange_type']		= $value['arrange_type'];
				$songData['collabo_artists']	= implode(',', $collaboArtistNames);
				
				$songDataList[$group->setlist_group_seq][$value->seq] = $songData;
			}
		}
		
		$songs			= empty($songDataList[0]) ? null : $songDataList[0];		// 通常セトリ
		$encore_songs	= empty($songDataList[1]) ? null : $songDataList[1];		// アンコールセトリ
		
		
		$params = array();
		
		$params['event_id'] = $event_id; // event_idは編集の場合のみ持たせる
		$params['event_date'] = $event_datetime->format('Y-m-d');
		$params['event_time'] = $event_datetime->format('H:i');
		$params['event_name'] = $event_data->name;
		$params['event_venue'] = $event_data->venue_name;
		$params['event_summary'] = $event_data->summary;
		$params['event_type'] = $event_data->event_type;
		$params['event_tag'] = $event_data->tag_text;
		$params['songs'] = $songs;
		$params['encore_songs'] = $encore_songs;
		
		//echo '<pre>' . var_export($params, true) . '</pre>';
		
		// アーティスト最初の1件だけ取得
		$artist = Artist::orderBy('artist_id', 'asc')->first();
		$params['artist'] = $artist;
		$params['songMasters'] = $songMasters;
		$params['artistMasters'] = $artistMasters;
		
		$artist = $artistMasters->where('artist_id', $setlist->artist_id)->first();
		$params['artist_name'] = $artist->name;
		
		return view('events/create')->with('params', $params);
	}
	
	public function destroy($id)
	{
		$task = Task::find($id);
		$task->delete();
		return redirect()->route('tasks.index');
	}
	
	/**
	 * 検索アクション
	 */
	public function search(Request $request)
	{
		$keyword = $request->input('keyword');
		$date_from = empty($request->input('date_from')) ? '1970-1-1' : $request->input('date_from');
		$date_to = empty($request->input('date_to')) ? '2099-1-1' : $request->input('date_to');
		
		$fromDate = new Datetime($date_from);
		$toDate = new Datetime($date_to);
		$toDate->setTime(23, 59, 59);	// その日の最後に設定
		// \Log::debug($fromDate->format('Y-m-d H:i:s'));
		// \Log::debug($toDate->format('Y-m-d H:i:s'));
		
		$artist_id = 0;
		
		// アーティスト名完全一致検索→artist_idが等しいセトリデータを検索して引っかかったイベントリストを表示
		$artist = Artist::where('name', $keyword)->first();
		
		$events = array();
		
		// アーティストが見つかった場合はアーティストから検索
		if (!empty($artist))
		{
			// 一致したアーティストのセトリリストを取得
			$setlists = Setlist::where('artist_id', $artist->artist_id)->get();
			
			// 抽出したイベントIDを含むイベントを全て取得
			$events = Event::whereIn('event_id', array_column($setlists->toArray(), 'event_id'))
						->whereBetween('datetime', [$fromDate, $toDate])
						->orderBy('datetime', 'desc')->get();
			
			$artist_id = $artist->artist_id;
		}
		// 通常はイベントデータから検索
		else
		{
			// keywordが空なら日付のみの検索
			if (empty($keyword))
			{
				$events = Event::whereBetween('datetime', [$fromDate, $toDate])
							->orderBy('datetime', 'desc')->get();
			}
			else
			{
				// イベント名、イベント概要、会場名、タグテキストを検索（完全一致）
				$events = Event::where('name', 'LIKE', "%$keyword%")
							->orWhere('summary', 'LIKE', "%$keyword%")
							->orWhere('venue_name', 'LIKE', "%$keyword%")
							->orWhere('tag_text', 'LIKE', "%$keyword%")
							->whereBetween('datetime', [$fromDate, $toDate])
							->orderBy('datetime', 'desc')->get();
			}
		}
		
		$params = array();
		$params['keyword'] = $keyword;
		$params['date_from'] = $request->input('date_from');
		$params['date_to'] = $request->input('date_to');
		$params['result'] = $events;
		$params['artist_id'] = $artist_id;
		return view('events/search')->with('params', $params);
	}
}
