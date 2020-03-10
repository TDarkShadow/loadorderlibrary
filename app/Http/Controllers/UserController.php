<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use App\Http\Middleware\IsOwner;
use App\LoadOrder;

class UserController extends Controller
{
	private $slug = '';

	public function __construct()
	{
		$this->middleware("auth", ['except' => ['show']]);
	}

	/**
	 * Display the specified resource
	 *
	 * @param  \App\User  $user
	 * @return \Illuminate\Http\Response
	 */
	public function show($username)
	{
		$loadOrders = \App\User::with(['loadOrder' => function ($query) {
			$query->where('is_private', false)->orderBy('updated_at', 'desc');
		}])->where('username', $username)->get();

		foreach ($loadOrders[0]->loadOrder as $loadOrder)

		{
			//dd($loadOrder->name);
		}

		//dd($loadOrders[0]->loadOrder[0]->game);

		return view('user.users-mods')
			->with('loadOrders', $loadOrders)
			->with('username', $loadOrders[0]->username);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  \App\User  $user
	 * @return \Illuminate\Http\Response
	 */
	public function edit()
	{
		$user = \App\User::find(\Auth::user()->id);

		return view('user.edit-user');
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \App\User  $user
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, User $user)
	{
		//
	}

	public function confirmDestroy()
	{
		return view('user.delete-account');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  \App\User  $user
	 * @return \Illuminate\Http\Response
	 */
	public function destroy()
	{
		$user = \App\User::find(\Auth::user()->id);

		$user->delete();
	}
}
