<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tournament;

class TournamentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->only(['addTournament']);
    }

    public function index()
    {
        return view('tournaments', [
            'tournaments' => Tournament::all()
        ]);
    }

    public function getTournament($id)
    {
        $tournament = Tournament::where('id', $id)->get();
        return view('tournaments', [
            'tournaments' => $tournament
        ]);
    }

    public function addTournament()
    {
        return view('addTournament');
    }

    public function addTournamentPost(Request $request)
    {
        Tournament::insert([
            'name' => $request->name,
            'date' => $request->date,
            'time' => $request->time,
            'rounds' => $request->rounds,
            'phone' => $request->phone,
            'email' => $request->email,
            'place' => $request->place
        ]);

        return view('home');
    }
}
