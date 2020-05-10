<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tournament extends Model
{
	public function participants()
	{
		if ($this->type == 'club')
			return $this->belongsToMany('App\Club');
		else if ($this->type == 'player')
			return $this->belongsToMany('App\Player');

		else
			return null;
	}
}
