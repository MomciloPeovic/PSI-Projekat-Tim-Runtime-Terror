<?php

namespace App\Http\Controllers;

use App\Club;
use App\Player;
use App\Tournament;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\MessageBag;

class ClubController extends Controller
{
    public function __construct()
    {
    }

    public function index()
    {
        return view('home');
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

    public function getPlayers($id)
    {
        $veze =  DB::table('club_player')->where('club_id','=',$id)->get();
        $uKlubu = false;
        $players = collect([]);

        foreach($veze as $veza)
        {
            if($veza->left == null) {
                $uKlubu == true;
                $players->push(DB::table('players')->where('id','=',$veza->player_id)->first());    
            }
        }
        if($uKlubu == false)
            return view('clubs.clubPlayerInfo');  
        else
        return view('players.playersTable')->with('players',$players);    
    }

    public function getClub($id)
    {
        $club = Club::where('id', $id)->first();
        return view('clubs.club')->with('club', $club);
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

    public function firePlayer(Request $id)
    {
        $player = DB::table('club_player')->where('player_id','=', $id)->first();
        if($player != null)
        {
            DB::table('club_player')->where('player_id','=',$id)->delete();
        }
        return view('home');
    }

    public function sendRequestToPlayer(Request $request)
    {
    
        DB::table('player_club_request')->insert([
            'player_id' => $request->player_id,
            'club_id' => $request->club_id,
            'club' => true
        ]);

        return view('home');
           
        /*
        //Primer kako poslati poruku greske ako je igrac vec uclanjen u klub
        $player = Player::where('id',$request->player_id)->first();
        $errors = new MessageBag(['error' => ['Igrac je vec u klubu!']]);
		return view('players.player_info')->with('player',$player)->withErrors($errors);
        */
    }

    public function acceptPlayer(Request $request)
    {

        //Provera da li je igrac slucajno vec u klubu
        $u_klubu = false;
        $veze = DB::table('club_player')->where('player_id','=',$request->player_id)->get();
        foreach($veze as $veza)
        {
            if($veza->left==null)
            {
                $u_klubu = true;
                break;
            }
        }

        //Ako nije uclanjuje se i brise se obavestenje
        if($u_klubu == false)
        {
            DB::table('club_player')->insert([
                'player_id' => $request->player_id,
                'club_id' => $request->club_id,
                'joined' => date('Y-m-d')
            ]);

            DB::table('player_club_request')
            ->where('player_id','=',$request->player_id)
            ->where('club_id','=',$request->club_id)
            ->delete();
        }
        //Ako jeste samo se brise obavestenje
        else
        {
            DB::table('player_club_request')
            ->where('player_id','=',$request->player_id)
            ->where('club_id','=',$request->club_id)
            ->delete();
        }
        
        $notifications = DB::table('player_club_request')->where('club_id','=',$request->club_id)->where('club','=',false)->get();
        $klub = Club::where('id','=',$request->club_id)->first();
        return view('clubs.clubNotifications')->with('notifications', $notifications)->with('klub',$klub);
    }

    public function declinePlayer(Request $request)
    {
        $veza = DB::table('player_club_request')->where('player_id','=', $request->player_id)->where('club_id', '=', $request->club_id)->first();
        if($veza != null)
        {
            DB::table('player_club_request')
            ->where('player_id','=',$veza->player_id)
            ->where('club_id','=',$veza->club_id)
            ->update(['club' => true,'rejection' => true]);
        }

        
        $notifications = DB::table('player_club_request')->where('club_id','=',$request->club_id)->where('club','=',false)->get();
        $klub = Club::where('id','=',$request->club_id)->first();
        return view('clubs.clubNotifications')->with('notifications', $notifications)->with('klub',$klub);
    }

    public function removeRequest(Request $request)
    {
        $veza = DB::table('player_club_request')->where('player_id','=', $request->player_id)->where('club_id', '=', $request->club_id)->first();
        if($veza != null)
        {
            DB::table('player_club_request')
            ->where('player_id','=', $veza->player_id)
            ->where('club_id', '=', $veza->club_id)->delete();
        }

        $notifications = DB::table('player_club_request')->where('club_id','=',$request->club_id)->where('club','=',false)->get();
        $klub = Club::where('id','=',$request->club_id)->first();
        return view('clubs.clubNotifications')->with('notifications', $notifications)->with('klub',$klub);
    }

    public function getNotifications($id)
    {
        $notifications = DB::table('player_club_request')->where('club_id','=',$id)->where('club','=',false)->get();
        $klub = Club::where('id','=',$id)->first();
        return view('clubs.clubNotifications')->with('notifications', $notifications)->with('klub',$klub);
    }
}
