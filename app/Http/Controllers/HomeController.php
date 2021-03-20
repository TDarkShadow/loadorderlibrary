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

        if (\Auth::check()) {
            $loadOrders = \App\Models\LoadOrder::where('user_id', \Auth::user()->id)->orderBy('updated_at', 'desc')->paginate(14);
		}
		
        return view('home')
            ->with('loadOrders', $loadOrders);
    }
}
