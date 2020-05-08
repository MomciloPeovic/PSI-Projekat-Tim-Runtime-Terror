<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User;

class Club extends User
{
    protected $fillable = [
        'name', 'email', 'password', 'founded', 'address', 'phone'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];
}
