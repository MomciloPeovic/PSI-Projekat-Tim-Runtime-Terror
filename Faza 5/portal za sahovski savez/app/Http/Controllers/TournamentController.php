<?php

namespace App\Http\Controllers;

use App\Player;
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
        return view('tournaments.tournaments', [
            'tournaments' => Tournament::orderByDesc('date')->orderByDesc('time')->get()
        ]);
    }

    public function getTournament($id)
    {
        $tournament = Tournament::where('id', $id)->first();
        return view('tournaments.tournament', [
            'tournament' => $tournament
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

        return view('home');
    }

    public function playerRegistration(Request $request)
    {
        $player = Player::where('id', $request->idIgrac)->get();

        $tournament = Tournament::where('id', $request->idTurnir)->first();

        $tournament->participants()->sync($player);

        return redirect('TournamentsController@index');
    }

    public function clubRegistration(Request $request)
    {
        $player = Player::where('id', $request->idKlub)->get();

        $tournament = Tournament::where('id', $request->idTurnir)->first();

        $tournament->participants()->sync($player);

        return redirect('TournamentsController@index');
    }
}
