<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class IntentionalErrorsController extends Controller
{
    //

	public function http500() 
	{
		return response()->json([
			'error' => 'This is an intentional 500 error.'
		], 500);
	}
}
