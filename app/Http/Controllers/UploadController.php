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

        dd($validated);
    }
}
