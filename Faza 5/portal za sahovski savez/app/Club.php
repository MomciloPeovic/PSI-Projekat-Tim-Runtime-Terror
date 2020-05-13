<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User;
use Illuminate\Notifications\Notifiable;

class Club extends User
{
    use Notifiable;

    protected $fillable = [
        'name', 'email', 'password', 'founded', 'address', 'phone'
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
}
