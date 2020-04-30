<?php

namespace App\Http\Controllers;

use App\LoadOrder;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Http\Requests\StoreUpload;
use Illuminate\Http\RedirectResponse;

class LoadOrderController extends Controller
{
	public function __construct()
	{
		$this->middleware("auth", ['except' => ['index', 'show', 'create', 'store']]);
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		$loadOrders = \App\LoadOrder::where('is_private', false)->orderBy('created_at', 'desc')->get();

		return view('load-orders')->with('loadOrders', $loadOrders);
	}

	/**
	 * Show form to create a list.
	 * Route GET /upload
	 *
	 * @return Illuminate\View\View
	 */
	public function create(): View
	{
		$games = \App\Game::orderBy('name', 'asc')->get();

		return view('upload')->with('games', $games);
	}

	/**
	 * Store the list in the DB.
	 * Route POST /upload
	 *
	 * @param StoreUpload $request
	 * @return RedirectResponse
	 */
	public function store(StoreUpload $request): RedirectResponse
	{
		$validated = $request->validated();

		$loadOrder = new \App\LoadOrder();
		$loadOrder->user_id     = auth()->check() ? auth()->user()->id : null;
		$loadOrder->game_id     = (int) $validated['game'];
		$loadOrder->slug        = \App\Helpers\CreateSlug::new($validated['name']);
		$loadOrder->name        = $validated['name'];
		$loadOrder->description = $validated['description'];
		$loadOrder->files       = $this->getFileNames($validated['files']);
		$loadOrder->is_private  = $request->input('private') != null;
		$loadOrder->save();

		// TODO: Change redirect to go to the list page itself.
		flash($loadOrder->name . ' successfully uploaded!')->success()->important();
		return redirect('lists/' . $loadOrder->slug);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  \App\LoadOrder  $loadOrder
	 * @return \Illuminate\Http\Response
	 */
	public function show(LoadOrder $loadOrder)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  \App\LoadOrder  $loadOrder
	 * @return \Illuminate\Http\Response
	 */
	public function edit(LoadOrder $loadOrder)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \App\LoadOrder  $loadOrder
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, LoadOrder $loadOrder)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  \App\LoadOrder  $loadOrder
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function destroy(LoadOrder $loadOrder): RedirectResponse
	{
		$this->authorize('delete', $loadOrder);

		$loadOrder->delete();
		flash($loadOrder->name . ' successfully deleted!');
		return redirect()->back();
	}

	/**
	 * Get a list of filenames with MD5 Hashes prepended, and store to disk if not already.
	 *
	 * @param array $files
	 * @return string
	 */
	private function getFileNames(array $files): string
	{
		$fileNames = [];

		foreach ($files as $file) {
			$contents = file_get_contents($file);
			$fileName = md5($file->getClientOriginalName() . $contents) . '-' . $file->getClientOriginalName();
			array_push($fileNames, $fileName);

			// Check if file exists, if not, save it to disk.
			if (!$this->checkFileExists($fileName)) {
				\Storage::putFileAs('uploads', $file, $fileName);
			}
		}

		return implode(',', $fileNames);
	}

	/**
	 * Check if a file already exists on disk.
	 *
	 * @param string $fileName
	 * @return boolean
	 */
	private function checkFileExists(string $fileName): bool
	{
		return in_array('uploads/' . $fileName, \Storage::files('uploads'));
	}
}
