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
		try {
			flash('Account <b>' . $name . '</b> successfully deleted!')->success()->important();
			Auth()->user()->delete();
			return redirect('/');
		} catch (\Throwable $th) {
			flash('Something went wrong with account deletion. Please <a href="https://github.com/phinocio/loadorderlibrary/issues/new">make a Github issue</a> and let Phin know.')->error()->important();
			return redirect()->back();
		}
	}
}
