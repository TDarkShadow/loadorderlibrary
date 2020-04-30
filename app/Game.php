<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
	public function loadOrders()
	{
		return $this->hasMany('\App\LoadOrder');
	}
}
