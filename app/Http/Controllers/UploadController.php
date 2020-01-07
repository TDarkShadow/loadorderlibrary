<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Game;
use App\Helpers\CreateSlug;

class UploadController extends Controller
{
	public function __construct()
	{ }
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		$games = Game::all();
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

		if (\Auth::check()) {
			$validatedData = $request->validate([
				'list-name' => 'required',
				'files.*' => 'required',
				'game' => 'required|not_in:0'
			]);
		} else {
			$validatedData = $request->validate([
				'files.*' => 'required',
				'game' => 'required|not_in:0'
			]);
		}

		//add forech and if for each file to validate
		// validateTxtFile()
		// validateIniFile()

		foreach ($request->file('files') as $file) {
			$name = trim(explode('.', $file->getClientOriginalName())[0]) . '.' . strtolower(trim(explode('.', $file->getClientOriginalExtension())[0]));

			$content = trim(file_get_contents($file));
			$content = explode("\r\n", $content);

			if ($name == "modlist.txt" || $name == "plugins.txt" || $name == "loadorder.txt") {
				unset($content[0]);
			}

			if ($name == "modlist.txt") {
				$content = array_reverse($content);
			}
			//TODO: It borked
			// if ($file->getClientOriginalExtension() == "txt" && $name != "modlist.txt") {
			// 	if($this->validateTxtFile($content) === false)
			// 	{
			// 		return redirect()->back()->withErrors('invalid-file', 'Please enter a valid file')->withInput();
			// 	}
			// }

			$contents[$name] = array_values($content);
		}

		$loadOrder = new \App\LoadOrder;


		if (\Auth::check()) {
			if ($request->input('private')) {
				$loadOrder->is_private = true;
			}

			$loadOrder->user_id = \Auth::user()->id;
			$loadOrder->description = $request->input('description');
			$slug = CreateSlug::new($request->input('list-name'));
		} else {
			$slug = CreateSlug::new('untitled-list');
		}


		$loadOrder->name = $request->input('list-name') ?? 'Untitled List';
		$loadOrder->game_id = $request->input('game');
		$loadOrder->slug = $slug;
		$loadOrder->load_order = json_encode($contents);


		$loadOrder->save();


		return redirect()->to('lo/' . $slug);
	}

	public function validateTxtFile($file)
	{
		$validLines = 0;

		//[\w\s\-\.]+\.(esm|esp|esl)
		foreach ($file as $line) {

			if (preg_match(
				'/^[\w\s\-\.]+\.(esm|esp|esl)/',
				$line
			)) {
				$validLines++;
			} else {
				return false;
			}
		}

		if ($validLines === count($file)) {
			//dd('true');
			return true;
		} else {
			//dd('false');
			return false;
		}
	}

	public function validateIniFile($file)
	{
		return @parse_ini_file($file) !== false;
	}
}
