<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\LoadOrder;

class ComparisonController extends Controller
{
    public function index()
    {
        return view('compare');
    }

    public function results(Request $request)
    {
        $compareTo = \App\LoadOrder::find($request->input('target'));
        $compareTo = (array) json_decode($compareTo->load_order);

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
        $missing = $this->compare($compareTo, $contents);

        return view('comparison')->with('missing', $missing);
    }

    protected function compare($compareTo, $upload)
    {
        $missing = [];
        foreach (array_keys($upload) as $key) {
            // Make sure the list you're comparing to has the file.
            if (isset($compareTo[$key])) {
                $diff = array_diff($compareTo[$key], $upload[$key]);

                if (count($diff) > 0) {
                    $missing += [
                        $key => $diff
                    ];
                }
            }
        }

        return $missing;
    }
}
