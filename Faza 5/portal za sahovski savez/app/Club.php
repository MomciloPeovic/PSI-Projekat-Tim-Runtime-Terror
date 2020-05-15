<?php

namespace App;

use Illuminate\Foundation\Auth\User;
use Illuminate\Notifications\Notifiable;

class Club extends User
{
    use Notifiable;

    protected $fillable = [
        'name', 'email', 'password', 'founded', 'municipality', 'address', 'phone'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

	public $timestamps = false;

    public function tournaments()
    {
        return $this->belongsToMany('App\Tournament');
    }

    public function players()
    {
        return $this->hasMany('App\Player');
    }

    public function playerCount() 
    {
        $playerCnt = Club::withCount('players')->get();
        return $playerCnt->players_count;
    }
}
