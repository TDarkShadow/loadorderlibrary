<?php

namespace App\Http\Controllers;

use App\Helpers\ValidFiles;
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
		$loadOrders = \App\LoadOrder::where('is_private', false)->orderBy('created_at', 'desc')->paginate(15);

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

		return view('upload')->with(['games' => $games, 'validFiles' => ValidFiles::all()]);
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

		
		$files = $this->getFileNames($validated['files']);
		
		$fileIds = [];
		foreach ($files as $file) {
			$file['clean_name'] = explode('-', $file['name'])[1];
			$file['size_in_bytes'] = \Storage::disk('uploads')->size($file['name']);
			dd($file, $file['name']);
			$fileIds[] = \App\File::firstOrCreate($file)->id;
		}
		
		$loadOrder = new \App\LoadOrder();
		$loadOrder->user_id     = auth()->check() ? auth()->user()->id : null;
		$loadOrder->game_id     = (int) $validated['game'];
		$loadOrder->slug        = \App\Helpers\CreateSlug::new($validated['name']);
		$loadOrder->name        = $validated['name'];
		$loadOrder->description = $validated['description'];
		$loadOrder->is_private  = $request->input('private') != null;
		$loadOrder->save();
		$loadOrder->files()->attach($fileIds);

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

		foreach ($loadOrder->files as $file) {

			$fileName = preg_replace('/[a-zA-Z0-9_]*-/i', '', $file->name);
			$content = explode("\n", trim(\Storage::get('uploads/' . $file->name)));

			// If the file is modlist.txt, plugin.txt, or loadorder.txt, remove the "generated by" line.
			if ($fileName == 'modlist.txt' || $fileName == 'loadorder.txt' || $fileName == 'plugins.txt') {
				unset($content[0]);
			}

			// Reverse the order of file so it is "human-readable" IE: the same order it's shown in MO2.
			// Also remove pre-fixed *, -, or + and indicate class, whether its a separator or disabled.
			$parsedContent = [];
			if ($fileName == 'modlist.txt') {
				$content = array_reverse($content);
			}

			foreach ($content as $line) {
				$class = null;
				if ($fileName == 'modlist.txt') {
					if (str_starts_with($line, '-')) {
						$class = 'list-disabled list-disabled-hidden';
						if (str_ends_with($line, '_separator')) {
							$class = 'list-separator';
							
							$line = str_replace('_separator', '', $line);
						}
					}

					$parsedContent[] = [
						"line" => substr($line, 1),
						"class" => $class
					];

				} else {
					// First, check if the file is plugins.txt
					if ($fileName == "plugins.txt") {
						$line = str_replace("*", '', $line);
					}
					$parsedContent[] = [
						"line" => $line,
						"class" => $class
					];
				}
				
			}

			
			array_push($files, ['name' => $fileName, 'content' => $parsedContent]);
		}

		$author = $loadOrder->author ? $loadOrder->author->name : 'Anonymous';

		return view('load-order')->with(['loadOrder' => $loadOrder, 'files' => $files, 'author' => $author]);
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

		if (config('app.url') . '/lists/' . $loadOrder->slug == back()->getTargetUrl()) {
			return redirect('/');
		}

		return back();
	}

	/**
	 * Get a list of filenames with MD5 Hashes prepended, and store to disk if not already.
	 *
	 * @param array $files
	 * @return array
	 */
	private function getFileNames(array $files): array
	{
		$fileNames = [];

		foreach ($files as $file) {
			$contents = file_get_contents($file);
			$contents = preg_replace('/[\r\n]+/', "\n", $contents);
			file_put_contents($file, $contents);
			$fileName = md5($file->getClientOriginalName() . $contents) . '-' . $file->getClientOriginalName();
			array_push($fileNames, ['name' => $fileName]);

			// Check if file exists, if not, save it to disk.
			if (!$this->checkFileExists($fileName)) {
				\Storage::putFileAs('uploads', $file, $fileName);
			}
		}

		return $fileNames;
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
