<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreUpload;
use Illuminate\Http\RedirectResponse;

class UploadController extends Controller
{   
    /**
     * Show the upload form.
     *
     * @return void
     */
    public function index()
    {
        $games = \App\Game::orderBy('name', 'asc')->get();

        return view('upload')->with('games', $games);
    }

    /**
     * Store the list in the DB.
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
        return redirect('upload')->with('success', 'List Uploaded!');
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
