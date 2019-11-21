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
use App\Util\ConstantManager;

class ArtistsController extends Controller
{
    // index
	public function index()
	{
		$artists = Artist::orderBy('artist_id', 'asc')->paginate(ConstantManager::PerPage);
		return view('artists/index')->with('artists', $artists);
	}
	
	// show
	public function show($artist_id)
	{
		$artist = Artist::where('artist_id', $artist_id)->first();
		if (empty($artist)){
            return abort('404');
		}
		$songs = Song::where('artist_id', $artist->artist_id)->orderby('name', 'asc')->get();

		// 最終編集者を取得
		$lastEditUser = User::where('id', $artist->edit_user_id)->first();
		
		// 一致したアーティストのセトリリストを取得
		$setlists = Setlist::where('artist_id', $artist->artist_id)->get();
		
		// 抽出したイベントIDを含むイベントを全て取得
		$eventArray = Event::whereIn('event_id', array_column($setlists->toArray(), 'event_id'))
					->orderBy('datetime', 'desc')->get()->toArray();
		
		// \Log::debug(print_r($eventArray, true));
		
		// Y-m-d形式に整形
		$eventDates = array();
		foreach ($eventArray as $event) {
			$eventDates[] = (new Datetime($event['datetime']))->format('"Y-n-j"');
		}
		
		$param = array();
		$param['artist'] = $artist;
		$param['lastEditUserName'] = empty($lastEditUser) ? '管理者' : $lastEditUser->screen_name;
		$param['lastEditTime'] = TimeManager::convert_to_fuzzy_time($artist->updated_at);
		$param['songs'] = $songs;
		$param['datesString'] = '['.implode(',', $eventDates).']'; // JavaScriptの配列として使用
		return view('artists/show')->with('param', $param);
	}
	
	// edit
	public function edit($artist_id)
	{
		$artist = Artist::where('artist_id', $artist_id)->first();
		return view('artists/edit')->with('artist', $artist);
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
	
	// destroy
	public function destroy($artist_id)
	{
		$artist = Artist::where('artist_id', $artist_id)->first();
		$artist->delete();
		
		// TODO : 関係する項目を全て削除する必要あり？誰でも削除できるのはまずいか
		
		return redirect()->route('artists.index');
	}
	
	// add
	public function add(Request $request)
	{
		$param = array();
		$param['artist'] = new Artist();
		
		//echo '<pre>' . var_export($param, true) . '</pre>';
		
		return view('artists/add')->with('param', $param);
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
	
	/**
	 * 検索アクション
	 */
	public function search(Request $request)
	{
		$keyword = $request->input('keyword');
		
		// アーティスト名部分一致で検索
		$artists = Artist::where('name', 'LIKE', "%$keyword%")->orderby('name', 'asc')->paginate(ConstantManager::PerPage);
		
		$params = array();
		$params['keyword'] = $keyword;
		$params['result'] = $artists;
		return view('artists/search')->with('params', $params);
	}
}
