<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\Test;

class UserController extends Controller
{
    public function index() {
		return view('user.profile');
	}
}
