<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Rules\ValidNumLines;

class UploadController extends Controller
{

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
		$validator = Validator::make($request->all(), [
			'name' => 'required',
			'description' => 'string|nullable',
			'game' => 'required',
			'files' => 'required',
			'files.*' => ['mimetypes:text/plain,application/x-wine-extension-ini', 'max:18', new ValidNumLines]
		], 
		[
			'files' => 'Files are required',
			'files.*.max' => 'Files may not be more than 128KB.',
			'files.*.mimes' => 'Files must be of type txt or ini'
		]);

		if ($validator->fails()) {
			return response()->json($validator->errors(), 400);
		}

		$files =
		$this->getFileNames((array) $request->file('files'));

		if (gettype($files) != 'string') {
			return response()->json([
					"error" => $files['error'],
					"note" => "it's likely that the getFileNames method cannot read the file names. Please ensure you have the files variable be exactly 'files[]'. If that doesn't work, contact Phin."
			], 422);
		}

		$loadOrder = new \App\LoadOrder();
		$loadOrder->user_id     = auth()->check() ? auth()->user()->id : null;
		$loadOrder->game_id     = (int) $request->input('game');
		$loadOrder->slug        = \App\Helpers\CreateSlug::new($request->input('name'));
		$loadOrder->name        = $request->input('name');
		$loadOrder->description = $request->input('description');
		$loadOrder->files       = $files;
		$loadOrder->is_private  = $request->input('private') != null;
		$loadOrder->save();


		// TODO: Change redirect to go to the list page itself.
		flash($loadOrder->name . ' successfully uploaded!')->success()->important();
		return response()->json([
			"url" => config('app.url') . "/lists/" . $loadOrder->slug
		]);
    }

	private function getFileNames(array $files)
	{

		$fileNames = [];

		foreach ($files as $file) {
			try {
				$contents = file_get_contents($file);
				$contents = preg_replace('~\R~u', "\n", $contents);
				file_put_contents($file, $contents);
				$fileName = md5($file->getClientOriginalName() . $contents) . '-' . $file->getClientOriginalName();
				array_push($fileNames, $fileName);

				// Check if file exists, if not, save it to disk.
				if (!$this->checkFileExists($fileName)) {
					\Storage::putFileAs('uploads', $file, $fileName);
				}
			} catch (\Throwable $th) {
				//throw $th;
				return [
					"error" => $th->getMessage()
				];
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
