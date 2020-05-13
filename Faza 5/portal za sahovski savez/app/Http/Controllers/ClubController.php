<?php

namespace App\Http\Controllers;

use App\Club;
use App\Player;
use App\Tournament;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ClubController extends Controller
{
    public function __construct()
    {
    }

    public function getClubs()
    {
        $clubs = Club::all();
        return view('clubs.clubs', [
            'clubs' => Club::orderByDesc('founded')->get()
        ]);
    }

    public function getClub($id)
    {
        $club = Club::where('id', $id)->first();
        return view('clubs.club')->with('club', $club);
    }

    public function addClub()
    {
        return view('clubs.addClub');
    }

    public function addOrEditClubPost(Request $request)
    {
        $club = Club::where('id', "=", $request->id)->first();
        if($club == null)
        {
            Club::insert([
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password),
                'founded' => $request->founded,
                'address' => $request->address,
                'phone' => $request->phone
            ]);
        }
        else
        {
            Club::where('id', $request->id)->update([
                'name' => $request->name,
                'email' => $request->email,
                'password' => $request->password,
                'founded' => $request->founded,
                'address' => $request->address,
                'phone' => $request->phone
            ]);
        }

        return view('home');
    }

    public function editClub($id)
    {
        $club = Club::where('id', $id)->first();
        return view('clubs.addClub')->with('club', $club);
    }

    public function deleteClub($id)
    {
        if (Club::where('id', "=", $id)->first() != null)
            Club::where('id', '=', $id)->delete();

        return view('home');
    }

    public function tournamentRegistration(Request $request)
    {
        $club = Club::where('id', $request->idKlub)->first();

        $tournament = Tournament::where('id', $request->idTurnir)->get();



        return view('home');
    }

    public function firePlayer(Request $request)
    {
        $club = Club::where('id', $request->idKlub)->first();

        $player = Player::where('id', $request->idIgrac)->get();



        return view('home');
    }

    public function answerPlayer(Request $request)
    {
        $club = Club::where('id', $request->idKlub)->first();

        $player = Player::where('id', $request->idIgrac)->get();



        return view('home');
    }
}
