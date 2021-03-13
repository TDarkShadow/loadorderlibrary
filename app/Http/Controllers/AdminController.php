<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Middleware\IsAdmin;

class AdminController extends Controller
{
	public function __construct()
	{
		$this->middleware(IsAdmin::class);
	}

    public function stats()
	{
		$orphanedFiles = \App\File::doesntHave('lists')->get();
		$userStats = [];
		$listStats = [];
		$fileStats = [];

		$users = \App\User::orderBy('created_at', 'desc')->get();
		$lists = \App\LoadOrder::all();
		$files = \App\File::all();
		$tmpFiles = \Storage::disk('tmp')->allFiles();

		
		$fileSize = 0;

		foreach ($files as $file) {
			$fileSize += $file->size_in_bytes;
		}

		$tmpSize = 0;

		foreach ($tmpFiles as $file) {
			$tmpSize += \Storage::disk('tmp')->size($file);
		}

		$userStats[] = [
			"name" => "Users",
			"value" => count($users)
		];

		$userStats[] = [
			"name" => "Admins",
			"value" => count($users->filter(function ($value, $key) {
				return $value->is_admin === 1;
			}))
		];
		$userStats[] = [
			"name" => "Last Registered",
			"value" => \Carbon\Carbon::createFromTimestamp($users[0]->created_at)->diffForHumans()
		];

		$listStats[] = [
			"name" => "Lists",
			"value" => count($lists)
		];

		$listStats[] = [
			"name" => "Private Lists",
			"value" => count($lists->filter(function ($value, $key) {
				return $value->is_private === 1;
			}))
		];

		$listStats[] = [
			"name" => "Percent Private",
			"value" => number_format(((count($lists->filter(function ($value, $key) {
				return $value->is_private === 1;
			})) / count($lists)) * 100), 2, '.', '') . "%"
		];

		$listStats[] = [
			"name" => "Anonymous Lists",
			"value" => count($lists->filter(function ($value, $key) {
				return $value->user_id == null;
			}))
		];

		$listStats[] = [
			"name" => "Percent Anonymous",
			"value" => number_format(((count($lists->filter(function ($value, $key) {
				return $value->user_id === null;
			})) / count($lists)) * 100), 2, '.', '') . "%"
		];

		$fileStats[] = [
			"name" => "Files",
			"value" => count($files)
		];

		$fileStats[] = [
			"name" => "File Size",
			"value" => number_format($fileSize / 1000000, 2, '.', '') // Divide by 1 million to get it into MB.
		];

		$fileStats[] = [
			"name" => "Tmp Size",
			"value" => number_format($tmpSize / 1000000, 2, '.', '') // Divide by 1 million to get it into MB.
		];

		return view('admin-stats')->with(['userStats' => $userStats, 'listStats' => $listStats, 'fileStats' => $fileStats, 'orphanedFiles' => $orphanedFiles]);
	}
}
