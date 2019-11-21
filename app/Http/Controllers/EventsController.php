<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Datetime;
use Exception;
use Auth;

use App\User;
use App\Artist;
use App\Song;
use App\Event;
use App\Setlist;
use App\SetlistGroup;
use App\SetlistSong;
use App\Util\TimeManager;
use App\Util\ConstantManager;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\HtmlString;

class EventsController extends Controller
{
	public function index()
	{
		return redirect('/');
	}
	
	public function show($event_id)
	{
		// ------------------------------------------- //
		// イベントデータ関連
		// ------------------------------------------- //
		// イベントデータを取得
		$event_data = Event::where('event_id', $event_id)->first()->toArray();
		if (empty($event_data)){
            return abort('404');
		}
		$event_data['event_type_text'] = ConstantManager::getEventTypeString($event_data['event_type']);
		// 概要にはリンクを入れることが可能
		if (!empty($event_data['summary'])) {
			$pattern = '/((?:https?|ftp):\/\/[-_.!~*\'()a-zA-Z0-9;\/?:@&=+$,%#]+)/';
			$replace = '<a href="$1">$1</a>';
			$event_data['summary'] = new HtmlString(nl2br(preg_replace($pattern, $replace, $event_data['summary'])));
		}

		// イベント最終編集者を取得
		$eventLastEditUser = User::where('id', $event_data['edit_user_id'])->first();
		// 最終編集者情報
		$eventLastEditUserName = empty($eventLastEditUser) ? '管理者' : $eventLastEditUser->screen_name;
		$eventLastEditTime = TimeManager::convert_to_fuzzy_time($event_data['updated_at']);

		// ------------------------------------------- //
		// セットリスト関連
		// ------------------------------------------- //
		// アーティストマスタを全件取得
		$artistMasters = Artist::get();

		// セットリスト配列
		$setlistArray = array();
		// アーティストIDリスト
		$artistIdList = array();
		
		// 複数アーティストのデータを登録すると複数取れる
		$setlists = Setlist::where('event_id', $event_id)->get();
		
		// 何かしらセットリストが見付かった場合のみ
		if (!empty($setlists)) {
	
			// 曲マスタリストを全件取得
			$songMasters = Song::get();

			foreach ($setlists as $setlist)
			{
				// 楽曲データのリスト初期化
				$songDataList = array();
	
				// セトリグループを取得
				$setlistGroups = SetlistGroup::where('setlist_id', $setlist->setlist_id)->get();
				foreach ($setlistGroups as $group) {
					// セトリ曲一覧
					$setlistSongs = SetlistSong::where('setlist_id', $setlist->setlist_id)->where('setlist_group_seq', $group->setlist_group_seq)->get();
					
					// セトリグループの種類ごとに曲名リストを作成する
					foreach ($setlistSongs as $value)
					{
						// コラボアーティストIDから名前を取得
						$collaboArtistIds = explode(',', $value->collabo_artist_ids);
						$collaboArtistNames = array();
						foreach($collaboArtistIds as $artistId){
							 if(empty($artistId)) continue;
							
							$artist = $artistMasters->where('artist_id', $artistId)->first();
							array_push($collaboArtistNames, $artist->name);
						}

						// 曲マスタを取得
						$songMaster = $songMasters->where('song_id', $value->song_id)->first();
						if (empty($songMaster)) {
							\Log::debug("曲マスタが取得できませんでした。 song_id = " . $value->song_id);
							continue;
						}

						// カバー曲の曲名変更
						$songName = $songMaster->name;
						if ($songMaster->artist_id != $setlist->artist_id) {
							$songArtist = $artistMasters->where('artist_id', $songMaster->artist_id)->first();
							$songName .= '(' . $songArtist->name . ')';
						}
						
						$songData = array();
						$songData['seq']				= $value->seq + 1;
						$songData['song_id']			= $songMaster->song_id;
						$songData['name']				= $songName;
						$songData['is_short']			= $value->is_medley;
						$songData['arrange_type_text']	= ConstantManager::getArrangeTypeString($value->arrange_type, true/* ignoreNormal */);
						$songData['collabo_artists']	= implode(',', $collaboArtistNames);
						$songData['edit_user_id']		= $value->edit_user_id;
						$songData['updated_at']			= $value->updated_at;
						
						$songDataList[$group->setlist_group_seq][$value->seq] = $songData;
					}
				}
	
				// 通常セトリ・アンコールセトリ
				$song_list			= empty($songDataList[0]) ? array() : $songDataList[0];
				$encore_song_list	= empty($songDataList[1]) ? array() : $songDataList[1];
				
				// セトリ曲データの一つを取り出して、最終編集データを取得
				$songSample = $song_list[0];
				$songLastEditUser = User::where('id', $songSample['edit_user_id'])->first();

				// アーティストデータ
				$artist = $artistMasters->where('artist_id', $setlist->artist_id)->first();
				$artistIdList[] = $artist->artist_id;

				// セットリストデータを作成して配列に追加する
				$setlistData = array();
				$setlistData['artist']				= $artist;
				$setlistData['song_list']			= $song_list;
				$setlistData['encore_song_list']	= $encore_song_list;
				$setlistData['lastEditUserName']	= empty($songLastEditUser) ? '管理者' : $songLastEditUser->screen_name;
				$setlistData['lastEditTime']		= TimeManager::convert_to_fuzzy_time($songSample['updated_at']);
				$setlistArray[] = $setlistData;
			}
		}
		
		$params = array();
		$params['event_data']			= $event_data;
		$params['eventLastEditUserName']= $eventLastEditUserName;
		$params['eventLastEditTime']	= $eventLastEditTime;
		$params['addableArtists']		= Artist::whereNotIn('artist_id', $artistIdList)->get();
		$params['setlistArray']			= $setlistArray;
		
		//echo '<pre>' . var_export($param, true) . '</pre>';
		
		return view('events/show')->with('params', $params);
	}
	
	public function create(Request $request)
	{
		$date = empty($request->input('date')) ? new Datetime() : new Datetime($request->input('date'));
		
		$params = array();
		$params['isEdit'] = false;
		$params['eventTypeStrings'] = ConstantManager::getEventTypeStringList();

		$params['event_id'] = null;
		$params['event_date'] = $date->format('Y-m-d');
		$params['event_time'] = null;
		$params['event_name'] = null;
		$params['event_venue'] = null;
		$params['event_summary'] = null;
		$params['event_type'] = 0;
		$params['event_tag'] = null;
		
		return view('events/create')->with('params', $params);
	}
	
	public function edit($event_id)
	{
		// イベントデータを取得
		$event_data = Event::where('event_id', $event_id)->first();
		$event_datetime = new Datetime($event_data->datetime);
		
		$params = array();
		$params['isEdit'] = true;
		$params['eventTypeStrings'] = ConstantManager::getEventTypeStringList();
		
		$params['event_id'] = $event_id; // event_idは編集の場合のみ持たせる
		$params['event_date'] = $event_datetime->format('Y-m-d');
		$params['event_time'] = $event_datetime->format('H:i');
		$params['event_name'] = $event_data->name;
		$params['event_venue'] = $event_data->venue_name;
		$params['event_summary'] = $event_data->summary;
		$params['event_type'] = $event_data->event_type;
		$params['event_tag'] = $event_data->tag_text;

		//echo '<pre>' . var_export($params, true) . '</pre>';
		
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
			'event_name'					=>'required|string|max:100',	// イベント名
			'event_venue'					=>'required|string|max:100',	// 会場名
			'event_summary'					=>'nullable|string|max:9999',	// イベント概要
			'event_type'					=>'integer|max:10',				// イベントタイプ
			'event_tag'						=>'nullable|string|max:100',	// イベントタグ
		];

		// バリデーションデータ作成
		$validation = \Validator::make($data, $rules);
		
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
		
		// 編集者ユーザーIDを取得しておく
		$edit_user_id = 0;
		if (!empty(Auth::user())) {
			$edit_user_id = Auth::user()->id;
		}
		
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
			$event->edit_user_id = $edit_user_id;
			$event->save();
			
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
		
		return redirect()->route('events.show', $event->event_id);
	}
	
	/**
	 * 削除アクション
	 */
	public function destroy($event_id)
	{
		try
		{
			// トランザクション開始
			DB::beginTransaction();

			// イベントを取得
			$event = Event::where('event_id', $event_id)->first();
			// セットリストを取得
			$setlist = Setlist::where('event_id', $event_id)->first();
			// セトリグループを取得
			$setlistGroups = SetlistGroup::where('setlist_id', $setlist->setlist_id)->get();
			
			// セトリ曲一覧を削除
			foreach ($setlistGroups as $group) {
				SetlistSong::where('setlist_id', $setlist->setlist_id)->where('setlist_group_seq', $group->setlist_group_seq)->delete();
			}

			// セトリグループ削除
			SetlistGroup::where('setlist_id', $setlist->setlist_id)->delete();
			// セットリスト削除
			$setlist->delete();
			// イベント削除
			$event->delete();
			
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
		
		return redirect('/');
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
	
	/**
	 * セットリストを追加
	 */
	public function editSetlist($event_id, $artist_id)
	{
		// アーティストマスタを取得
		$artistMasters = Artist::orderby('artist_id', 'asc')->get();
		// 楽曲をすべて取得 TODO: 他アーティストの楽曲を沢山登録していった場合負荷が掛かり過ぎる恐れがある
		$songMasters = Song::orderby('name', 'asc')->get();

		// イベントデータ取得
		$event = Event::where('event_id', $event_id)->first();
		// アーティストを取得
		$artist = $artistMasters->where('artist_id', $artist_id)->first();

		// 指定アーティストのセットリストを取得
		$setlist = Setlist::where('event_id', $event_id)->where('artist_id', $artist_id)->first();
		
		if (!empty($setlist))
		{
			// 曲データのリストを初期化
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
						
						$collaboArtist = $artistMasters->where('artist_id', $artistId)->first();
						array_push($collaboArtistNames, $collaboArtist->name);
					}
					
					// 曲データを作成
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

			$isEdit = true;
		} else {
			$isEdit = false;
		}
		
		$params = array();
		$params['isEdit'] = $isEdit;
		$params['songMasters'] = $songMasters;
		$params['arrangeTypeStrings'] = ConstantManager::getArrangeTypeStringList();
		
		$params['event'] = $event;
		$params['artist'] = $artist;
		$params['songs'] = empty($songs) ? null : $songs;
		$params['encore_songs'] = empty($encore_songs) ? null : $encore_songs;

		
		//echo '<pre>' . var_export($params, true) . '</pre>';
		
		return view('events/setlists/create')->with('params', $params);
	}
	
	/**
	 * セットリストを保存
	 */
	public function storeSetlist(Request $request, $event_id, $artist_id)
	{
		$data = $request->all();
		//echo '<pre>' . var_export($data, true) . '</pre>';
		
		// 値の検証
		$rules = [
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
		
		// 編集者ユーザーIDを取得しておく
		$edit_user_id = 0;
		if (!empty(Auth::user())) {
			$edit_user_id = Auth::user()->id;
		}

		// 指定アーティストのセットリストを取得を試みる
		$setlist = Setlist::where('event_id', $event_id)->where('artist_id', $artist_id)->first();
		
		try
		{
			// トランザクション開始
			DB::beginTransaction();
			
			// setlistデータ登録
			// セットリストがあるかどうかで編集か新規作成かを分ける
			if (empty($setlist)) {
				$setlist = new Setlist();
				$setlist->event_id = $event_id;
				$setlist->artist_id = $artist_id;
				$setlist->save();
			}
			
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
				$songData['edit_user_id'] = $edit_user_id;
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
				$songData['edit_user_id'] = $edit_user_id;
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
	
	/**
	 * セットリスト削除アクション
	 */
	public function destroySetlist(Request $request, $event_id, $artist_id)
	{
		try
		{
			// トランザクション開始
			DB::beginTransaction();
			// 指定アーティストのセットリストを取得を試みる
			$setlist = Setlist::where('event_id', $event_id)->where('artist_id', $artist_id)->first();
			// セトリグループを取得
			$setlistGroups = SetlistGroup::where('setlist_id', $setlist->setlist_id)->get();
			
			// セトリ曲一覧を削除
			foreach ($setlistGroups as $group) {
				SetlistSong::where('setlist_id', $setlist->setlist_id)->where('setlist_group_seq', $group->setlist_group_seq)->delete();
			}

			// セトリグループ削除
			SetlistGroup::where('setlist_id', $setlist->setlist_id)->delete();
			// セットリスト削除
			$setlist->delete();
			
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
		
		return redirect()->route('events.show', $event_id);
	}
}
