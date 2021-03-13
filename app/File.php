<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    use HasFactory;

	protected $fillable = ['name', 'clean_name', 'size_in_bytes'];

	public function lists()
	{
		return $this->belongsToMany('\App\LoadOrder');
	}
}
