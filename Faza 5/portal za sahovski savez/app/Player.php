<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Player extends Model
{
	public function tournaments()
	{
		return $this->belongsToMany('App\Tournament');
	}
}
