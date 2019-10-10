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
		
		// 曲マスタリストを取得
		$song_master = Song::where('artist_id', $setlist->artist_id)->get();
		
		// セトリグループを取得
		$setlistGroups = SetlistGroup::where('setlist_id', $setlist->setlist_id)->get();
		foreach ($setlistGroups as $group) {
			// セトリ曲一覧
			$setlistSongs = SetlistSong::where('setlist_id', $setlist->setlist_id)->where('setlist_group_seq', $group->setlist_group_seq)->get();
			
			// セトリグループの種類ごとに曲名リストを作成する
			foreach ($setlistSongs as $value)
			{
				$songDataList[$group->setlist_group_seq][$value->seq] = $song_master->where('song_id', $value->song_id)->first()->toArray();
				$songDataList[$group->setlist_group_seq][$value->seq]['seq'] = $value->seq + 1;
			}
		}
		
		$song_list			= empty($songDataList[0]) ? null : $songDataList[0];		// 通常セトリ
		$encore_song_list	= empty($songDataList[1]) ? null : $songDataList[1];		// アンコールセトリ
		
		// イベントデータを取得
		$event_data = Event::where('event_id', $event_id)->first();
		
		$param = array();
		$param['song_list'] = $song_list;
		$param['encore_song_list'] = $encore_song_list;
		$param['event_data'] = $event_data;
		
		//echo '<pre>' . var_export($param, true) . '</pre>';
		
		return view('events/show')->with('param', $param);
	}
	
	public function create()
	{
		$params = array();
		
		// アーティスト最初の1件だけ取得
		$artist = Artist::orderBy('artist_id', 'asc')->first();
		$params['artist'] = $artist;
		// アーティストIDが等しいアーティストの楽曲をすべて取得
		$songs = Song::where('artist_id', $artist['artist_id'])->orderby('name', 'asc')->get();
		$params['songs'] = $songs;
		
		$params['event_id'] = null;
		$params['event_date'] = (new Datetime())->format('Y-m-d');
		$params['event_time'] = null;
		$params['event_name'] = null;
		$params['event_venue'] = null;
		$params['event_summary'] = null;
		$params['song_names'] = null;
		$params['encore_song_names'] = null;
		
		return view('events/create')->with('params', $params);
	}
	
	public function store(Request $request)
	{
		$data = $request->all();
		//echo '<pre>' . var_export($data, true) . '</pre>';
		
		// 値の検証
		$rules = [
			'event_date'			=>'required|string|max:10',			// 年月日 xxxx-xx-xx
			'event_time'			=>'required|string|max:5',			// 時分 xx:xx
			'event_name'			=>'required|string|max:100',		// イベント名
			'event_venue'			=>'required|string|max:100',		// 会場名
			'event_summary'			=>'nullable|string|max:100',		// イベント概要
			'artist_id'				=>'required|numeric',				// アーティストID
			'setlist_group_type'	=>'required|numeric',				// セットリストグループタイプ
			'song_names'			=>'required|array|min:1',			// 曲名リスト
			'song_names.*'			=>'string|max:100',					// 曲名
			'encore_song_names'		=>'required|array|min:1',			// アンコール曲名リスト
			'encore_song_names.*'	=>'string|max:100',					// アンコール曲名
		];
		
		// リストの後ろに曲名が空の要素がある場合は予め弾いておく
		for($i = count($data['song_names']) - 1; $i >= 0; $i--)
		{
			if (empty($data['song_names'][$i]))
			{
				unset($data['song_names'][$i]);
			}
			else
			{
				// 空じゃない要素が来たら終了
				break;
			}
		}
		for($i = count($data['encore_song_names']) - 1; $i >= 0; $i--)
		{
			if (empty($data['encore_song_names'][$i]))
			{
				unset($data['encore_song_names'][$i]);
			}
			else
			{
				// 空じゃない要素が来たら終了
				break;
			}
		}
		
		// バリデーション
		$validation = \Validator::make($data, $rules);
		
		// 曲名リストがちゃんと含まれているかを確認
		$songs = Song::where('artist_id', $data['artist_id'])->orderby('name', 'asc')->get()->toArray();
		foreach($data['song_names'] as $key => $name)
		{
			if (array_search($name, array_column($songs, 'name')) === false)
			{
				// 含まれなかったらエラー追加
				$validation->errors()->add('song_names.'.$key, '指定された楽曲データが存在しません');
			}
		}
		foreach($data['encore_song_names'] as $key => $name)
		{
			if (array_search($name, array_column($songs, 'name')) === false)
			{
				// 含まれなかったらエラー追加
				$validation->errors()->add('encore_song_names.'.$key, '指定された楽曲データが存在しません');
			}
		}
		
		// 確認
		if (!empty($validation->errors()->all()))
		{
			return redirect()->back()->withErrors($validation->errors())->withInput();
		}
		
		// バリデーションOK
		
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
			$event->save();
			
			// setlistデータ登録
			if (empty($event_id)) {
				$setlist = new Setlist();
				$event_id = empty($event->event_id) ? $event->id : $event->event_id;
			} else {
				$setlist = Setlist::where('event_id', $event_id)->first();
			}
			$setlist->event_id = $event_id;
			$setlist->artist_id = $data['artist_id'];
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
			foreach($data['song_names'] as $key => $name)
			{
				$song_index = array_search($name, array_column($songs, 'name'));
				if ($song_index === false) {
					// TODO: 曲名からIDが取れなかった(上で確認してるからありえない)
					echo '<pre>' . var_export($data['song_names'], true) . '</pre>';
					throw new Exception();
				}
				$song_id = $songs[$song_index]['song_id'];
				
				$songData = array();
				$songData['setlist_id'] = $setlistGroup->setlist_id;
				$songData['setlist_group_seq'] = 0;
				$songData['seq'] = $key;
				$songData['song_id'] = $song_id;
				$songData['is_medley'] = false;
				$songData['collabo_artist_ids'] = "";
				$songData['arrange_type'] = 0;
				$songData['created_at'] = new DateTime();
				$songData['updated_at'] = new DateTime();
				
				array_push($setlistSongs, $songData);
			}
			foreach($data['encore_song_names'] as $key => $name)
			{
				$song_index = array_search($name, array_column($songs, 'name'));
				if ($song_index === false) {
					// TODO: 曲名からIDが取れなかった(上で確認してるからありえない)
					echo '<pre>' . var_export($data['encore_song_names'], true) . '</pre>';
					throw new Exception();
				}
				$song_id = $songs[$song_index]['song_id'];
				
				$songData = array();
				$songData['setlist_id'] = $setlistGroup->setlist_id;
				$songData['setlist_group_seq'] = 1;
				$songData['seq'] = $key;
				$songData['song_id'] = $song_id;
				$songData['is_medley'] = false;
				$songData['collabo_artist_ids'] = "";
				$songData['arrange_type'] = 0;
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
		$song_master = Song::where('artist_id', $setlist->artist_id)->get();
		
		$songNamesList = array();
		
		// セットリストグループを取得(通常、アンコールなど取得できる)
		$setlistGroups = SetlistGroup::where('setlist_id', $setlist->setlist_id)->get();
		foreach ($setlistGroups as $group) {
			// セトリ曲一覧
			$setlistSongs = SetlistSong::where('setlist_id', $setlist->setlist_id)->where('setlist_group_seq', $group->setlist_group_seq)->get();
			
			// セトリグループの種類ごとに曲名リストを作成する
			foreach ($setlistSongs as $value)
			{
				$songNamesList[$group->setlist_group_seq][$value->seq] = $song_master->where('song_id', $value->song_id)->first()->name;
			}
		}
		
		$song_names			= empty($songNamesList[0]) ? null : $songNamesList[0];		// 通常セトリ
		$encore_song_names	= empty($songNamesList[1]) ? null : $songNamesList[1];		// アンコールセトリ
		
		
		$params = array();
		
		$params['event_id'] = $event_id; // event_idは編集の場合のみ持たせる
		$params['event_date'] = $event_datetime->format('Y-m-d');
		$params['event_time'] = $event_datetime->format('H:i');
		$params['event_name'] = $event_data->name;
		$params['event_venue'] = $event_data->venue_name;
		$params['event_summary'] = $event_data->summary;
		$params['song_names'] = $song_names;
		$params['encore_song_names'] = $encore_song_names;
		
		//echo '<pre>' . var_export($params, true) . '</pre>';
		
		// アーティスト最初の1件だけ取得
		$artist = Artist::orderBy('artist_id', 'asc')->first();
		$params['artist'] = $artist;
		// アーティストIDが等しいアーティストの楽曲をすべて取得
		$songs = Song::where('artist_id', $artist['artist_id'])->orderby('name', 'asc')->get();
		$params['songs'] = $songs;
		
		return view('events/create')->with('params', $params);
	}
	
	public function update(Request $request, $id)
	{
		$task = Task::find($id);
		$task->fill($request->all());
		$task->save();
		return redirect()->route('tasks.index');
	}
	
	public function destroy($id)
	{
		$task = Task::find($id);
		$task->delete();
		return redirect()->route('tasks.index');
	}
}