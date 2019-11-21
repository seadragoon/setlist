<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Event;
use App\Util\ConstantManager;

class IndexController extends Controller
{
	public function index()
	{
		// 1ページの項目数
		$perPage = 15;

		$events = Event::orderBy('datetime', 'desc')->paginate(ConstantManager::PerPage);
		
		//$params = array();
		//$params['events'] = $events;
		
		return view('/index')->with('events', $events);
	}
}
