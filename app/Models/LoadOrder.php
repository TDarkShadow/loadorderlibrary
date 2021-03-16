<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoadOrder extends Model
{
	use HasFactory;

	protected $with = ['files'];

	public function game()
	{
		return $this->belongsTo('\App\Game');
	}

	public function author()
	{
		return $this->belongsTo('\App\User', 'user_id');
	}

	public function files()
	{
		return $this->belongsToMany('\App\File');
	}
}
