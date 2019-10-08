<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Event;

class IndexController extends Controller
{
	public function index()
	{
		$events = Event::orderBy('datetime', 'desc')->get();
		
		//$params = array();
		//$params['events'] = $events;
		
		return view('/index')->with('events', $events);
	}
}
