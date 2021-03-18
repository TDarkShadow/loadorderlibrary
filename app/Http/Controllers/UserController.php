<?php

namespace App\Http\Controllers;

class UserController extends Controller
{
    public function index() {
		return view('user.profile');
	}

	public function destroy() {
		$name = auth()->user()->name;
		try {
			flash('Account <b>' . $name . '</b> and all its lists successfully deleted!')->success()->important();
			auth()->user()->delete();
			return redirect('/');
		} catch (\Throwable $th) {
			flash('Something went wrong with account deletion. Please <a href="https://github.com/phinocio/loadorderlibrary/issues/new">make a Github issue</a> and let Phin know.')->error()->important();
			return redirect()->back();
		}
	}
}
