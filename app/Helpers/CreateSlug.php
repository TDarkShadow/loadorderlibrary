<?php

namespace App\Helpers;

use App\Models\LoadOrder;
use Illuminate\Support\Str;

class CreateSlug
{

	static function new($name)
	{
		$slug = Str::slug($name, '-');

		$latestSlug = LoadOrder::whereRaw("slug RLIKE '^{$slug}(-[0-9]*)?$'")->latest('id')->value('slug');
		
		if($latestSlug) {
			$pieces = explode('-', $latestSlug);

			$number = intval(end($pieces));

			$slug .= '-' . ($number + 1);
		}

		return $slug;
	}
}
