<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Http\Requests\StoreUpload;
use Illuminate\Http\RedirectResponse;

class LoadOrderController extends Controller
{
	public function __construct()
	{
		$this->middleware("auth", ['except' => ['index', 'show', 'create', 'store']]);
	}

	/**
	 * Show all lists that are not private.
	 * Route GET /lists
	 *
	 * @return \Illuminate\View\View
	 */
	public function index(): View
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
	 * Show a specific list
	 *
	 * @param  \App\LoadOrder  $loadOrder
	 * @return \Illuminate\View\View
	 */
	public function show(\App\LoadOrder $loadOrder)
	{	
		$files = [];
		

		foreach(explode(',', $loadOrder->files) as $file) {
			$fileName = preg_replace('/[a-zA-Z0-9_]*-/i', '', $file);
			array_push($files, ['name' => $fileName, 'content' => trim(\Storage::get('uploads/' . $file))]);
		}

		return view('load-order')->with(['loadOrder' => $loadOrder, 'files' => $files]);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  \App\LoadOrder  $loadOrder
	 * @return \Illuminate\Http\Response
	 */
	public function edit(\App\LoadOrder $loadOrder)
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
	public function update(Request $request, \App\LoadOrder $loadOrder)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  \App\LoadOrder  $loadOrder
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function destroy(\App\LoadOrder $loadOrder): RedirectResponse
	{
		$this->authorize('delete', $loadOrder);

		$loadOrder->delete();
		flash($loadOrder->name . ' successfully deleted!')->success();

		if(env('APP_URL') . '/lists/' . $loadOrder->slug == back()->getTargetUrl()) {
			return redirect('/');
		}
		
		return back();
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
			$contents = preg_replace('~\R~u', "\n", $contents);
			file_put_contents($file, $contents);
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
