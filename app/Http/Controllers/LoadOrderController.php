<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoadOrderController extends Controller
{
	//
	public function __construct()
	{
		//auth isOwner;
	}

	public function index()
	{
		$loadOrders = \App\LoadOrder::where('is_private', false)->orderBy('updated_at', 'desc')->get();
		
		return view('loadorders')
			->with('loadOrders', $loadOrders);
	}
	
	public function show($slug)
	{
		$guest = 1;
		$loadOrder = \App\LoadOrder::where('slug', $slug)->first();
		
		

		if($loadOrder->user_id == null)
		{
			$guest = 0;
		}
		
		$list = json_decode($loadOrder->load_order);
		$keys = array_keys((array) $list);
		//dd($keys);
		return view('loadorder')
			->with('loadOrder', $loadOrder)
			->with('list', (array) $list)
			->with('keys', $keys)
			->with('guest', $guest);
	}

	public function edit($slug)
	{
		return view('user.edit-list');
	}


	public function destroy($slug)
	{
		$deleted = \App\LoadOrder::where('slug', $slug)->delete();

		return redirect()->to('/');
	}
}
