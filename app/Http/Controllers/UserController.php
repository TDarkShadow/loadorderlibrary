<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use App\Http\Middleware\IsOwner;

class UserController extends Controller
{
	private $slug = '';

	public function __construct()
	{
		$this->middleware("auth", ['except' => ['show']]);
		$this->middleware(IsOwner::Class, ['except' => ['show']]);
	}

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
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
    public function edit($username)
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
    public function destroy($username)
    {
		$user = \App\User::find(\Auth::user()->id);

		$user->delete();
    }
}
