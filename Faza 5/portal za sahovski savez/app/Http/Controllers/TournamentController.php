<?php

namespace App\Http\Controllers;

use App\Club;
use App\Player;
use App\Result;
use Illuminate\Http\Request;
use App\Tournament;
use Illuminate\Support\Facades\Auth;

class TournamentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->only(['addTournament']);
    }

    public function index()
    {
        return view('tournaments.tournaments', [
            'tournaments' => Tournament::orderByDesc('date')->orderByDesc('time')->get()
        ]);
    }

    public function getTournament($id)
    {
        $tournament = Tournament::where('id', $id)->first();
        $rounds = Result::where('tournament_id', $tournament->id)->distinct('round')->count();
        return view('tournaments.tournament', [
            'tournament' => $tournament,
            'rounds' => $rounds
        ]);
    }

    public function addTournament()
    {
        return view('tournaments.addTournament');
    }

    public function addTournamentPost(Request $request)
    {
        //to do: validations

        Tournament::insert([
            'name' => $request->name,
            'date' => $request->date,
            'time' => $request->time,
            'rounds' => $request->rounds,
            'phone' => $request->phone,
            'email' => $request->email,
            'place' => $request->place,
            'type' => $request->type
        ]);

        return redirect()->action('TournamentController@index');
    }

    public function playerRegistration(Request $request)
    {
        $player = Player::where('id', $request->idIgrac)->get();

        $tournament = Tournament::where('id', $request->idTurnir)->first();

        $tournament->participants()->toggle($player);

        return redirect()->action('TournamentController@index');
    }

    public function clubRegistration(Request $request)
    {
        $club = Club::where('id', $request->idKlub)->get();

        $tournament = Tournament::where('id', $request->idTurnir)->first();


        $tournament->participants()->toggle($club);

        return redirect()->action('TournamentController@index');
    }
}
