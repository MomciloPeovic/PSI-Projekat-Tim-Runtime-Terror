<?php

namespace App\Http\Controllers;

use App\ArbiterRank;
use App\Player;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PlayerController extends Controller
{
    public function __construct()
    {
        
    }

    public function getPlayers()
    {
        $players = Player::all();
        $arbiterRanks = ArbiterRank::all();
            return view('players.players', [
                'players' => $players,
                'arbiterRanks' => $arbiterRanks
            ]);
    }

    public function getPlayersPost(Request $data)
    {

        $limit = 3;
        $strana = $data->strana;
        $start = ($strana-1)*$limit;


        $min_rejting_filter = $data->min_rejting_filter; 
        if($min_rejting_filter == "") $min_rejting_filter = 0;
        $max_rejting_filter = $data->max_rejting_filter; 
        if($max_rejting_filter == "") $max_rejting_filter = 3000;
        
        $players = "";

        if($data->pol_filter == "Svi")
            $players = Player::where('name','like',"%".$data->ime_filter."%")->whereBetween('rating',[$min_rejting_filter,$max_rejting_filter])->offset($start)
            ->limit($limit)->get();
        else  
        $players = Player::where('name','like',"%".$data->ime_filter."%")
                ->whereBetween('rating',[$min_rejting_filter,$max_rejting_filter])
                ->where('gender',$data->pol_filter)
                ->offset($start)
                ->limit($limit)
                ->get();

        $broj = 0;
        if($data->pol_filter == "Svi")
        $broj =  Player::where('name','like',"%".$data->ime_filter."%")->whereBetween('rating',[$min_rejting_filter,$max_rejting_filter])->count();
        else $broj = Player::where('name','like',"%".$data->ime_filter."%")
        ->whereBetween('rating',[$min_rejting_filter,$max_rejting_filter])
        ->where('gender',$data->pol_filter)->count();
        $stranice = ceil($broj/$limit);
        

        return view('players.players_table')->with('players',$players)->with('broj_stranica',$stranice);
    }

    public function getPlayer($id)
    {
        $player = Player::where('id', $id)->first();
        return view('players.player_info')->with('player',$player);
    }
    
    public function addPlayer()
    {
        return view('players.addPlayer');
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
            if($request->rating !=null)
            {
                Player::where('id', $request->id)->update([
                    'name' => $request->name,
                    'surname' => $request->surname,
                    'gender' => $request->gender,
                    'email' => $request->email,
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
                    'birth_date' => $request->birth_date,
                ]);
            }
        }

        return view('home');
    }

    public function editPlayer($id)
    {
        $player = Player::where('id', $id)->first();
        return view('players.addPlayer')->with('player', $player);
    }

    public function deletePlayer($id)
    {
        if(Player::where('id',"=", $id)->first() != null)
            Player::where('id','=',$id)->delete();

        return view('home');
    }

    public function sendRequestToClub(Request $request)
    {  
        DB::table('player_club_request')->insert([
            'player_id' => $request->player_id,
            'club_id' => $request->club_id,
            'club' => false
        ]);

        return view('home');
    }

    public function myClub($id)
    {

        $u_klubu = false;
        $veze =  DB::table('club_player')->where('player_id','=',$id)->get();
        foreach($veze as $veza)
        {
            if($veza->left == null)
                $u_klubu = true;
        }
        if($u_klubu == false)
            return view('players.player_club_info');       
        else
        {
            $klub = DB::table('clubs')->where('id','=',$veza->club_id)->first();
            return redirect('/klub/'.$klub->id);
        }
    }
    
    public function leaveClub($id)
    {
        $veza = DB::table('club_player')->where('player_id','=', $id)->first();
        if($veza != null)
        {
            DB::table('club_player')->where('player_id','=',$id)->delete();
        }
        return view('home');
    }

    public function referees()
    {
        $players = Player::all();
        return view('admin.referees', ['players' => $players]);
    }

    public function promote($id)
    {
        $player = Player::where('id', $id)->first();
        $arbiterRanks = ArbiterRank::all();
        return view('admin.promote', [
            'player' => $player,
            'arbiterRanks' => $arbiterRanks
        ]);
    }

    public function promotePost(Request $request)
    {
        Player::where('id', $request->id)->update([
            'arbiter_rank_id' => $request->rang
        ]);

        return redirect()->action('PlayerController@referees');
    }
}

