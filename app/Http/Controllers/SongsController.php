<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Artist;
use App\Song;

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
		$artist = Artist::where('artist_id', $song->artist_id)->first();
		
		$param = array();
		$param['artist'] = $artist;
		$param['song'] = $song;
		return view('songs/show')->with('param', $param);
	}
	
	// edit
	public function edit($song_id)
	{
		$song = Song::where('song_id', $song_id)->first();
		return view('songs/edit')->with('song', $song);
	}
	
	
	// update
	public function update(Request $request, $song_id)
	{
		$song = Song::where('song_id', $song_id)->first();
		$song->fill($request->all());
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
		$song->save();
		return redirect()->route('artists.show', $song->artist_id);
	}
}
