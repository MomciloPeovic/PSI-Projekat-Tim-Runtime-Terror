<?php

namespace App\Http\Controllers;

use App\Player;
use Illuminate\Http\Request;

class PlayerController extends Controller
{
    public function __construct()
    {
    }

    public function show()
    {
        $players = Player::all();
        return view('players', [
            'players' => $players
        ]);
    }
}
