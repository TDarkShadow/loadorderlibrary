<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WelcomeController extends Controller
{
	public function __construct()
	{
		// $this->middleware("guest");
	}

	public function index()
	{
		if(\Auth::check())
		{
			$loadOrders = \App\LoadOrder::where('user_id', \Auth::user()->id)->orderBy('updated_at', 'desc')->get();
			
			return view('welcome')
				->with('loadOrders', $loadOrders);
		}
		return view('welcome');
	}
}
