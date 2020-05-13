<?php

namespace App\Http\Controllers;

use App\Player;
use Illuminate\Http\Request;

class PlayerController extends Controller
{
    public function __construct()
    {
    }

    public function getPlayers()
    {
        $players = Player::all();
            return view('players', [
                'players' => $players
            ]);
    }

    public function getPlayer($id)
    {
        $player = Player::where('id', $id)->first();
        return view('player_info')->with('player',$player);
    }
    
    public function addPlayer()
    {
        return view('addPlayer');
    }

    public function addOrEditPlayerPost(Request $request)
    {
        $player = Player::where('id',"=", $request->id)->first();
        if($player == null)
        {
            Player::insert([
                'name' => $request->name,
                'surname' => $request->surname,
                'gender' => $request->gender,
                'email' => $request->email,
                'password' => $request->password,
                'birth_date' => $request->birth_date,
                'rating' => $request->rating
            ]);
        }
        else
        {
            Player::where('id', $request->id)->update([
                'name' => $request->name,
                'surname' => $request->surname,
                'gender' => $request->gender,
                'email' => $request->email,
                'password' => $request->password,
                'birth_date' => $request->birth_date,
                'rating' => $request->rating
            ]);
        }

        return view('home');
    }

    public function editPlayer($id)
    {
        $player = Player::where('id', $id)->first();
        return view('addPlayer')->with('player', $player);
    }

    public function deletePlayer($id)
    {
        if(Player::where('id',"=", $id)->first() != null)
            Player::where('id','=',$id)->delete();

        return view('home');
    }
}

