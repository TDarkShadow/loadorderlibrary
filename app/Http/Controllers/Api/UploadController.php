<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\LoadOrderController;
use App\Http\Requests\StoreUpload;

class UploadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUpload $request)
    {
		$validated = $request->validated();
		$loadOrder = new \App\LoadOrder();
		$loadOrder->user_id     = auth()->check() ? auth()->user()->id : null;
		$loadOrder->game_id     = (int) $validated['game'];
		$loadOrder->slug        = \App\Helpers\CreateSlug::new($validated['name']);
		$loadOrder->name        = $validated['name'];
		$loadOrder->description = $validated['description'];
		$loadOrder->files       = $this->getFileNames((array) $validated['files']);
		$loadOrder->is_private  = $request->input('private') != null;
		$loadOrder->save();


		// TODO: Change redirect to go to the list page itself.
		flash($loadOrder->name . ' successfully uploaded!')->success()->important();
		return response()->json([
			"url" => env('APP_URL') . "/lists/" . $loadOrder->slug
		]);
    }

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
