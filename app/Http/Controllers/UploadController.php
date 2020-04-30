<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUpload;
use Illuminate\Http\Request;

class UploadController extends Controller
{
    public function index()
    {
        $games = \App\Game::orderBy('name', 'asc')->get();

        return view('upload')->with('games', $games);
    }

    public function store(StoreUpload $request)
    {
        $validated = $request->validated();
        $loadOrder = new \App\LoadOrder();

        if(auth()->check()) {
            $loadOrder->slug = \App\Helpers\CreateSlug::new($validated['name']);
            if ($request->input('private')) {
                $loadOrder->is_private = true;
            }
            $loadOrder->user_id = auth()->user()->id;
            $loadOrder->description = $validated['description'];
            $loadOrder->name = $validated['name'];
        } else {
            $loadOrder->slug = \App\Helpers\CreateSlug::new('untitled-list');
        }

        $loadOrder->game_id = (int)$validated['game'];

        //Check if file already saved by someone via Hash.

        //Generate array of file names for load_order.
        $files = [];

        foreach($validated['files'] as $file) 
        {
            $contents = file_get_contents($file);
            $fileName = md5($file->getClientOriginalName() . $contents) . '-' . $file->getClientOriginalName();
            array_push($files, $fileName);

            // Check if file exists, if not, save it to disk.
            if(!$this->checkFileExists($fileName))
            {
                echo 'no exists!';
                \Storage::putFileAs('uploads', $file, $fileName);
            }
        }

        $loadOrder->files = implode(',', $files);
        $loadOrder->save();

        // TODO: Change redirect to go to the list page itself.
        return redirect('upload')->with('status', 'List Uploaded!');
    }

    private function checkFileExists($fileName)
    {
        return in_array('uploads/' . $fileName, \Storage::files('uploads'));
    }
}
