<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Middleware\IsAdmin;
use App\Models\Backup;
use App\Models\File;
use App\Models\LoadOrder;
use App\Models\User;
use Storage;

class AdminController extends Controller
{
	public function __construct()
	{
		$this->middleware(IsAdmin::class);
	}

    public function stats()
	{
		$userStats = [];
		$listStats = [];
		$fileStats = [];
		
		$users = User::orderBy('created_at', 'desc')->get();
		$lists = LoadOrder::all();
		$files = File::with('lists')->get();
		$filesInLists = File::has('lists')->get();
		$orphanedFiles = File::doesntHave('lists')->get();
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
			"name" => "Verified Authors",
			"value" => count($users->filter(function ($value, $key) {
				return $value->is_verified === 1;
			}))
		];

		$userStats[] = [
			"name" => "Last Registered",
			"value" => \Carbon\Carbon::createFromTimestamp($users[0]->created_at)->diffForHumans()
		];

		$userStats[] = [
			"name" => "Without Email",
			"value" => count($users->filter(function ($value, $key) {
				return $value->email === null;
			}))
		];

		$userStats[] = [
			"name" => "Without List",
			"value" => count($users->filter(function ($value, $key) {
				return count($value->lists) === 0;
			}))
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

		return view('admin.stats')->with(['userStats' => $userStats, 'listStats' => $listStats, 'fileStats' => $fileStats, 'orphanedFiles' => $orphanedFiles, 'filesInLists' => $filesInLists]);
	}

	public function users()
	{

		$users = User::select('id', 'name', 'email', 'is_verified', 'created_at')->withCount('lists')->get();
		return view('admin.users')->with(['users' => $users]);
	}

	public function backups()
	{	
		$backups = Backup::orderBy('created_at', 'desc')->get();
		return view('admin.backups')->with(['backups' => $backups]);
	}

	public function downloadBackup($id) 
	{
		$backup = Backup::find($id);

		return \Storage::download('backup/' . $backup->file);
	}

	public function deleteBackup($id)
	{
		$backup = Backup::find($id);

		// Delete on disk
		Storage::disk('backup')->delete($backup->file);

		// Delete from DB
		$backup->delete();

		return redirect()->back();
	}

	public function verify(User $user) {

		$user->is_verified = !$user->is_verified;
		$user->save();

		return redirect()->back();
	}
}
