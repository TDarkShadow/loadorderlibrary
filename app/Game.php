<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
	//


	public $timestamps = false;

	public function loadOrder()
	{
		return $this->hasMany('App\LoadOrder');
	}
}
