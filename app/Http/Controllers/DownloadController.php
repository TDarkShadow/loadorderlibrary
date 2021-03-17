<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use ZipArchive;

class DownloadController extends Controller
{
    public function index(\App\Models\LoadOrder $loadOrder, $fileName)
	{
		$listFiles = [];

		foreach ($loadOrder->files as $file) {
			array_push($listFiles, $file->name);
		}

		// DL all files.
		if($fileName == 'all') {
			$zip = new ZipArchive;
			$zipFile = $loadOrder->name . '.zip';
			if($zip->open(storage_path('app/tmp/' . $zipFile), ZipArchive::CREATE)) {
				foreach($listFiles as $file) {
					$zip->addFile(storage_path('app/uploads/' . $file), preg_replace('/[a-zA-Z0-9_]*-/i', '', $file));
				}
				$zip->close();
				
				return \Storage::download('tmp/' . $zipFile);
			}
		}

		$file = implode(preg_grep("/$fileName/", $listFiles));
		
		return \Storage::download('uploads/' . $file, $fileName);

	}
}
