<?php

namespace App\Http\Controllers;

use Datetime;

use App\Event;
use App\Util\ConstantManager;

class IndexController extends Controller
{
	public function index()
	{
		$currentDate = new Datetime();

		$events = Event::where('datetime', '<', $currentDate)->orderBy('datetime', 'desc')->paginate(ConstantManager::PerPage);
		
		//$params = array();
		//$params['events'] = $events;
		
		return view('/index')->with('events', $events);
	}
}
