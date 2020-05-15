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
            'clubs' => Club::orderByDesc('founded')->get(),
            'numPlayers' => 0
        ]);
    }

    public function getClubsPost(Request $data)
    {
        $limit = 3;
        $strana = $data->strana;
        $start = ($strana-1)*$limit;

        $min_datum_filter = $data->min_datum_filter;
        if($min_datum_filter == "") $min_datum_filter = date(1900-1-1);
        $max_datum_filter = $data->max_datum_filter;
        if($max_datum_filter == "") $max_datum_filter = date("Y-m-d");

        $clubs = "";

        $clubs = Club::where('name', 'like', "%".$data->naziv_filter."%" )
        ->where('municipality', 'like', "%".$data->opstina_filter."%")
        ->whereBetween('founded',[$min_datum_filter, $max_datum_filter])
        ->offset($start)
        ->limit($limit)
        ->get();

        $numPages = Club::where('name', 'like', "%".$data->naziv_filter."%" )
        ->where('municipality', 'like', "%".$data->opstina_filter."%")
        ->whereBetween('founded',[$min_datum_filter, $max_datum_filter])->count();

        $num = ceil($numPages/$limit);

        return view('clubs.clubsTable')->with('clubs',$clubs)->with('broj_stranica',$num);
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
                'municipality' => $request->municipality,
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
                'municipality' => $request->municipality,
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

    public function firePlayer(Request $request)
    {
        $club = Club::where('id', $request->idKlub)->first();

        $player = Player::where('id', $request->idIgrac)->get();

        $club->players()->toggle($player);

        return view('home');
    }

    public function answerPlayer(Request $request)
    {
        $club = Club::where('id', $request->idKlub)->first();

        $player = Player::where('id', $request->idIgrac)->get();

        

        return view('home');
    }

    public function requestPlayer($club_id,$player_id)
    {
        
    }
}
