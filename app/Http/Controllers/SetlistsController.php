<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Datetime;

use Auth;
use App\User;
use App\Artist;
use App\Song;
use App\Event;
use App\Setlist;
use App\Util\TimeManager;

class SetlistsController extends Controller
{
    // index
	public function index()
	{
	}
	
	// show
	public function show($setlist_id)
	{
	}
	
	// add
	public function add(Request $request)
	{
		\Log::debug("setlists.add");

		$data = $request->all();

		// 値の検証
		$rules = [
			'event_id' =>'required|integer|max:10',		// イベントID
			'artist_name' =>'required|string|max:100',	// アーティスト名
		];

		// アーティストマスタを取得
		$artistMasters = Artist::get()->toArray();
		
		// バリデーションデータ作成
		$validation = \Validator::make($data, $rules);
		
		// バリデーション確認
		if (!empty($validation->errors()->all()))
		{
			\Log::debug("validation error.");
			\Log::debug(var_export($validation->errors(), true));
			return redirect()->back()->withErrors($validation->errors())->withInput();
		}

		// アーティスト名の確認
		$artist = 0;
		$targetIndex = array_search($data['artist_name'], array_column($artistMasters, 'name'));
		if ($targetIndex === false){
			// 含まれなかったらエラー追加
			$validation->errors()->add('artist_name_wrong', '※指定された名前のアーティストは定義されていません');
		} else {
			// 見つかった場合はアーティストIDを保持しておく
			$artist = $artistMasters[ $targetIndex ];
		}
		
		// バリデーション確認
		if (!empty($validation->errors()->all()))
		{
			\Log::debug("validation error.");
			\Log::debug(var_export($validation->errors(), true));
			return redirect()->back()->withErrors($validation->errors())->withInput();
		}
		
		// バリデーションOK

		// イベントデータ取得
		$event = Event::where('event_id', $data['event_id'])->first();
		
		// 楽曲をすべて取得 TODO: 他アーティストの楽曲を沢山登録していった場合負荷が掛かり過ぎる恐れがある
		$songMasters = Song::orderby('name', 'asc')->get();
		$params['arrangeTypeStrings'] = ConstantManager::getArrangeTypeStringList();
		
		$params = array();
		$params['isEdit'] = false;
		$params['songMasters'] = $songMasters;
		$params['artistMasters'] = $artistMasters;
		
		$params['event'] = $event;
		$params['artist'] = $artist;
		$params['songs'] = null;
		$params['encore_songs'] = null;
		
		//echo '<pre>' . var_export($param, true) . '</pre>';
		
		return view('setlists/create')->with('params', $params);
	}
	
	// edit
	public function edit($artist_id)
	{
		$artist = Artist::where('artist_id', $artist_id)->first();
		return view('setlists/edit')->with('artist', $artist);
	}
	
	// update
	public function update(Request $request, $artist_id)
	{
		$artist = Artist::where('artist_id', $artist_id)->first();
		$artist->fill($request->all());
		if (!empty(Auth::user())) {
			$artist->edit_user_id = Auth::user()->id;
		}
		$artist->save();
		return redirect()->route('artists.index');
	}
	
	// store
	public function store(Request $request)
	{
		//echo '<pre>' . var_export($request, true) . '</pre>';
		
		$artist = new Artist();
		$artist->fill($request->all());
		if (!empty(Auth::user())) {
			$artist->edit_user_id = Auth::user()->id;
		}
		$artist->save();
		return redirect()->route('artists.index');
	}
	
	// destroy
	public function destroy($artist_id)
	{
		$artist = Artist::where('artist_id', $artist_id)->first();
		$artist->delete();
		
		// TODO : 関係する項目を全て削除する必要あり？誰でも削除できるのはまずいか
		
		return redirect()->route('artists.index');
	}
}
