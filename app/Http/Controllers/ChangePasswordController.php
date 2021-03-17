<?php

namespace App\Http\Controllers;

use App\Rules\ValidPassword;
use Illuminate\Http\Request;
use App\Models\User;

class ChangePasswordController extends Controller
{

	public function __construct()
	{
		$this->middleware('auth');
	}

	public function index()
	{
		return view('change-password');
	}

	public function store(Request $request) 
	{
		$this->validator($request->all())->validate();
		$user = User::find(auth()->user()->id)->first();
		$user->password = \Hash::make($request->input('password'));
		$user->save();
		flash('Password changed!')->success();
		return back();
		
	}

	protected function validator(array $data)
	{
		return \Validator::make($data, [
			'current' => ['required', 'string', new ValidPassword],
			'password' => ['required', 'string', 'min:8', 'confirmed'],
		]);
	}
}
