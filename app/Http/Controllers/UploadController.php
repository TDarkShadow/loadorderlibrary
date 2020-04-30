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
        } else {
            $loadOrder->slug = \App\Helpers\CreateSlug::new('untitled-list');
        }

        $loadOrder->game_id = (int)$validated['game'];

        //Check if file already saved by someone via Hash.

        //Generate array of file names for load_order.
        $files = [];

        foreach($validated['files'] as $file) 
        {
            array_push($files, $file->getClientOriginalName());
        }

        dd((string)$files);


        dd($loadOrder->getAttributes());
    }
}
