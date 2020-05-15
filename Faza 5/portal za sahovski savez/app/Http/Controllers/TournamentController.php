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
        $this->middleware('auth')->except(['index', 'getTournament']);
    }

    public function index()
    {
        return view('tournaments.tournaments', [
            'tournaments' => Tournament::orderByDesc('start_date')->orderByDesc('time')->get()
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
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
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

    public function arbiters($id)
    {
        $tournament = Tournament::where('id', $id)->first();
        $arbiters = Player::whereNotNull('arbiter_rank_id')->get();
        return view('tournaments.arbiters', [
            'tournament' => $tournament,
            'arbiters' => $arbiters
        ]);
    }

    public function addArbiter(Request $request)
    {
        $tournament = Tournament::where('id', $request->id)->first();
        $tournament->arbiters()->syncWithoutDetaching($request->arbiter_id);
        return redirect('/turnir/' . $request->id . '/sudije');
    }

    public function removeArbiter(Request $request)
    {
        $tournament = Tournament::where('id', $request->id)->first();
        $tournament->arbiters()->detach($request->arbiter_id);
        return redirect('/turnir/' . $request->id . '/sudije');
    }
}
