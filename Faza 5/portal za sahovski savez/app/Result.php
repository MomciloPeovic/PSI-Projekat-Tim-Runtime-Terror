<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    public function white()
    {
        return $this->belongsTo('App\Player')->first();
    }

    public function black()
    {
        return $this->belongsTo('App\Player')->first();
    }

    public function tournament()
    {
        return $this->belongsTo('App\Tournament')->first();
    }
}
