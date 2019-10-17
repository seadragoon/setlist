<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Artist;
use App\Song;

class AggregateController extends Controller
{
    // index
	public function index()
	{
		//$artists = Artist::orderBy('artist_id', 'asc')->get();
		
		$params = array();
		for($i=0;$i<10;$i++){
			$data = array();
			$data['name']  = '楽曲名_'.$i;
			$data['count'] = $i;
			
			array_push($params, $data);
		}
		return view('aggregate/index')->with('params', $params);
	}
}
