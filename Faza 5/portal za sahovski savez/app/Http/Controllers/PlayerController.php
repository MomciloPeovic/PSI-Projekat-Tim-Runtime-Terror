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

    public function addPlayer()
    {
        return view('addPlayer');
    }

    public function addPlayerPost(Request $request)
    {
        Player::insert([
            'name' => $request->name,
            'surname' => $request->surname,
            'email' => $request->email,
            'password' => $request->password,
            'birth_date' => $request->birth_date,
            'rating' => $request->rating
        ]);

        return view('home');
    }
}
