<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Artist;
use App\Song;

class ArtistsController extends Controller
{
    // index
	public function index()
	{
		$artists = Artist::orderBy('artist_id', 'asc')->get();
		return view('artists/index')->with('artists', $artists);
	}
	
	// show
	public function show($artist_id)
	{
		$artist = Artist::where('artist_id', $artist_id)->first();
		$songs = Song::where('artist_id', $artist->artist_id)->orderby('name', 'asc')->get();
		
		$param = array();
		$param['artist'] = $artist;
		$param['songs'] = $songs;
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
