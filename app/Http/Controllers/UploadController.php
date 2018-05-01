<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class UploadController extends Controller
{
	public function __construct()
	{
		if (Route::getFacadeRoot()->current()->uri() == 'guest/upload') {
			
			//return redirect()->to(\Auth::user()->username . '/upload');
		}
	}
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		$games = \App\Game::all();
		return view('upload')->with('games', $games);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {	
		$loadOrder = '';

		if(\Auth::check())
		{
			$validatedData = $request->validate([
				'list-name' => 'required',
				'files.*' => 'required|mimes:txt|max:2048',
				'game' => 'required|not_in:0'
			]);
		} else {
			$validatedData = $request->validate([
				'files.*' => 'required|mimes:txt|max:2048',
				'game' => 'required|not_in:0'
			]);
		}
		

		foreach ($request->file('files') as $file) {
			$name = trim(explode('.', $file->getClientOriginalName())[0]) . '.' . strtolower(trim(explode('.', $file->getClientOriginalExtension())[0]));

			$content = trim(file_get_contents($file));
			$content = explode("\r\n", $content);

			if($name == "modlist.txt" || $name == "plugins.txt")
			{
				unset($content[0]);
			}

			if($name == "modlist.txt")
			{
				$content = array_reverse($content);
			}

			$contents[$name] = array_values($content);

		}

		$loadOrder = new \App\LoadOrder;


		if(\Auth::check())
		{	
			if($request->input('private'))
			{
				$loadOrder->is_private = true;
			}

			$loadOrder->user_id = \Auth::user()->id;
			$loadOrder->description = $request->input('description');
			$slug = $this->generateUserSlug($request->input('list-name'));

		} else {
			$slug = $this->generateGuestSlug($contents);
		}


		$loadOrder->name = $request->input('list-name');
		$loadOrder->game_id = $request->input('game');
		$loadOrder->slug = $slug;
		$loadOrder->load_order = json_encode($contents);


		$loadOrder->save();


		return redirect()->to('lo/' . $slug);
	}

	public function generateGuestSlug($content)
	{
		return substr(md5(serialize($content)), 0, 10);
	}

	public function generateUserSlug($listName)
	{
		$slug = $this->buildSlugFromName($listName);

		if(\App\LoadOrder::where('slug', $slug)->orderBy('slug', 'desc')->first() != null)
		{
			$number = explode('-', $slug);
			$number = array_reverse($number);

			$slug .= '-' . ((int) $number[0] + 1);
		}

		return $slug;
	}

	public function buildSlugFromName($name)
	{
		$delimiter = "-";
		$name = preg_replace("/[^a-zA-Z0-9\/_|+ -]/", '', \Auth::user()->username . '-' . $name);
		$name = strtolower(trim($name, '-'));
		$name = preg_replace("/[\/_|+ -]+/", $delimiter, $name);
		return $name;
	}

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
