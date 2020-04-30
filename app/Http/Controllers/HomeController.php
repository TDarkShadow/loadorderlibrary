<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $loadOrders = '';
        $compare = \App\LoadOrder::where('name', '!=', 'Untitled List')->where('is_private', false)->get();

        if (\Auth::check()) {
            $loadOrders = \App\LoadOrder::where('user_id', \Auth::user()->id)->orderBy('updated_at', 'desc')->get();
		}
		
        return view('home')
            ->with('loadOrders', $loadOrders)
            ->with('compare', $compare);
    }
}
