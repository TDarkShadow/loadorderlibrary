<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ComparisonController extends Controller
{
	public function index(): View
	{

		$loadOrders = \App\LoadOrder::where('is_private', false)->orderBy('created_at', 'desc')->get();

		return view('compare')->with('loadOrders', $loadOrders);
	}

	public function post(Request $request): RedirectResponse
	{

		$request->validate([
			'list1' => 'required',
			'list2' => 'required',
		]);

		return redirect("/compare/" . $request['list1'] . "/" . $request['list2']);
	}

	public function results($list1, $list2)
	{
		$list1 = \App\LoadOrder::where('is_private', false)->where('slug', $list1)->first();
		$list2 = \App\LoadOrder::where('is_private', false)->where('slug', $list2)->first();

		$this->compareLists($list1, $list2);
	}

	private function compareLists($list1, $list2) {
		// Check if the names are the same
		$list1Files = explode(',', $list1->files);
		$list2Files = explode(',', $list2->files);

		dd($list1Files, $list2Files);
	}
}
