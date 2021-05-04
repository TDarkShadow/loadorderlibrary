<?php

namespace App\Http\Controllers;

use App\Helpers\ValidFiles;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Http\Requests\StoreUpload;
use App\Http\Requests\UpdateLoadOrder;
use Illuminate\Http\RedirectResponse;
use App\Models\LoadOrder;
use App\Models\Game;
use App\Models\User;
use App\Models\File;

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
	public function index(Request $request): View
	{
		$game = Game::whereName($request->query('game'))->first();
		$author = User::whereName($request->query('author'))->first();
		$query = LoadOrder::whereIsPrivate(false);
		$sort = $request->query('sort') ?? null;


		if ($game) {
			$query->whereGameId($game->id);
		}

		if ($author) {
			$query->whereUserId($author->id);
		}	

		if ($sort == 'updated') {
			$query->orderBy('updated_at', 'desc');
		} else {
			$query->orderBy('created_at', 'desc');
		}

		$loadOrders = $query->paginate(14);

		return view('load-orders')->with(['loadOrders' => $loadOrders, 'game' => $game]);
	}

	/**
	 * Show form to create a list.
	 * Route GET /upload
	 *
	 * @return Illuminate\View\View
	 */
	public function create(): View
	{
		$games = Game::orderBy('name', 'asc')->get();

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
			$fileIds[] = File::firstOrCreate($file)->id;
		}
		
		$loadOrder = new LoadOrder();
		$loadOrder->user_id     = auth()->check() ? auth()->user()->id : null;
		$loadOrder->game_id     = (int) $validated['game'];
		$loadOrder->slug        = \App\Helpers\CreateSlug::new($validated['name']);
		$loadOrder->name        = $validated['name'];
		$loadOrder->description = $validated['description'];
		$loadOrder->version 	= $validated['version'];
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
	public function show(LoadOrder $loadOrder)
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
					}
					
					if (str_ends_with($line, '_separator')) {
						$class = 'list-separator';

						$line = str_replace('_separator', '', $line);
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
	public function edit(LoadOrder $loadOrder)
	{
		if (auth()->user()->id !== $loadOrder->user_id)
		{
			abort(403);
		}
		
		$games = Game::orderBy('name', 'asc')->get();
		return view('edit-load-order')->with(['games' => $games, 'loadOrder' => $loadOrder, 'validFiles' => ValidFiles::all()]);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \App\LoadOrder  $loadOrder
	 * @return \Illuminate\Http\Response
	 */
	public function update(UpdateLoadOrder $request, LoadOrder $loadOrder)
	{
		if (auth()->user()->id !== $loadOrder->user_id) {
			abort(403);
		}

		$validated = $request->validated();

		$fileIds = [];

		if (isset($validated['files'])) {
			$files = $this->getFileNames($validated['files']);
	
			foreach ($files as $file) {
				$file['clean_name'] = explode('-', $file['name'])[1];
				$file['size_in_bytes'] = \Storage::disk('uploads')->size($file['name']);
				$fileIds[] = File::firstOrCreate($file)->id;
			}
			// Check if an uploaded file is overwritting an existing file
			foreach ($files as $file) {
				$cleanName = explode('-', $file['name'])[1];
				$overwrite = preg_grep("/$cleanName/", $validated['existing']);
				if ($overwrite) {
					$keyToRemove = array_keys($overwrite);
					unset($validated['existing'][$keyToRemove[0]]);			
				}
			}
		}


		// Generate fileIds for ->sync()
		foreach ($validated['existing'] as $file) {
			$fileIds[] = (int) explode('-', $file)[1];
		}

		$loadOrder->game_id     = (int) $validated['game'];
		$loadOrder->name        = $validated['name'];
		$loadOrder->description = $validated['description'];
		$loadOrder->version 	= $validated['version'];
		$loadOrder->is_private  = $request->input('private') != null;
		$loadOrder->save();
		$loadOrder->files()->sync($fileIds);

		// TODO: Change redirect to go to the list page itself.
		flash($loadOrder->name . ' successfully updated!')->success()->important();
		return redirect('lists/' . $loadOrder->slug);
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
