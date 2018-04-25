<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoadOrderController extends Controller
{
	//
	
	public function show($slug)
	{
		$guest = 1;
		$loadOrder = \App\LoadOrder::where('slug', $slug)->first();
		
		

		if($loadOrder->user_id == null)
		{
			$guest = 0;
		}

		$author = $loadOrder->user->username;
		$uploaded_at = $loadOrder->created_at;
		$updated_at = $loadOrder->updated_at;
		$name = $loadOrder->name;
		$description = $loadOrder->description;
		
		$loadOrder = json_decode($loadOrder->load_order);
		$keys = array_keys((array) $loadOrder);

		return view('loadorder')
			->with('loadOrder', (array) $loadOrder)
			->with('keys', $keys)
			->with('guest', $guest)
			->with('listInfo', [$author, $uploaded_at, $updated_at, $name, $description]);
	}
}
