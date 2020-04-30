<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RedirectController extends Controller
{
	public function redirectToLists(string $slug)
	{
		return redirect('/lists/' . $slug, 301);
	}
}
