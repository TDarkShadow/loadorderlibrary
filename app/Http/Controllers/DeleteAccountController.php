<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DeleteAccountController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth');
	}

	public function index()
	{
		return view('delete-account');
	}

	public function destroy()
	{
		$name = Auth()->user()->name;
		Auth()->user()->delete();
		flash('Account <b>' . $name . '</b> successfully deleted!')->success()->important();
		return redirect('/');
	}
}
