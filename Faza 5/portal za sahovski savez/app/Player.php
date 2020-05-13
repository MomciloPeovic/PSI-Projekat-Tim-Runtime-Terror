<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User;
use Illuminate\Notifications\Notifiable;

class Player extends User
{
	use Notifiable;

	protected $fillable = [
		'name', 'surname', 'email', 'password', 'rating', 'birth_date'
	];

	protected $hidden = [
		'password', 'remember_token',
	];


	public $timestamps = false;

	public function tournaments()
	{
		return $this->belongsToMany('App\Tournament');
	}

	public function club()
	{
		return $this->belongsTo('App\Club');
	}

	public function isArbiter()
	{
		if ($this->belongsTo('App\ArbiterRank', 'arbiter_rank_id')->first() != null)
			return true;

		return false;
	}

	public function getArbiterRank()
	{
		if ($this->isArbiter()) {
			return $this->belongsTo('App\ArbiterRank', 'arbiter_rank_id')->first()->name;
		}

		return null;
	}
}
