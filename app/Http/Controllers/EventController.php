<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Event;

class EventController extends Controller
{
	public function index()
	{
		$results = Event::whereDate('date', '>=', 'now')->orderBy('date', 'ASC')->orderBy('time', 'ASC')->get();
			
		return response()
			->json(compact('results'));
	}
}
