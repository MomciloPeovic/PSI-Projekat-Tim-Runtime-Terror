@extends('master')
@section('title','Informacije o igracu')
@section('content')

<form action="/igrac/dodaj" method="POST">
@csrf
<div class="container-fluid mt-1 ml-5">
    <div id="igrac-profil">
        <div class="row">
            <div class="col-sm-3 mt-4">

                <div class="text-center">
                    <img src="http://ssl.gstatic.com/accounts/ui/avatar_2x.png" style="width: 500px"
                        class="avatar img-circle img-thumbnail" alt="avatar">
                    <div class="col-sm-12">
                        <h1>{{$player->name}} {{$player->surname}}</h1>
                    </div>
                </div>
                <hr>
                <a href="/igrac" class="badge badge-primary"> < Nazad</a>
            </div>
            <div class="col-sm-4 mt-4">
                <div class="tab-content">
                    @auth('player')
                    @if(Auth::guard('player')->user()->id == $player->id)
                        <input type="hidden" name="id" value="{{Auth::user()->id}}">
                    @endif
                    @endauth
                    <div class="tab-pane active" id="home">

                            <div class="form-group">
                                <div class="col-xs-6">
                                    <label for="first_name">
                                        <h4>Ime</h4>
                                    </label>
                                    <div class="alert alert-info" for="first_name">
                                        @auth('player')
                                        @if(Auth::user()->id == $player->id)
                                            <input type="text" class="form-control" value="{{$player->name}}" name="name" required>
                                        @else
                                            <h5>{{$player->name}}</h5>
                                        @endif
                                        @endauth

                                        @guest('player')
                                            <h5>{{$player->name}}</h5>
                                        @endguest
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-xs-6">
                                    <label for="last_name">
                                        <h4>Prezime</h4>
                                    </label>
                                    <div class="alert alert-info" for="last_name">
                                        @auth('player')
                                        @if(Auth::user()->id == $player->id)
                                            <input type="text" class="form-control" value="{{$player->surname}}" name="surname" required>
                                        @else
                                            <h5>{{$player->surname}}</h5>
                                        @endif
                                        @endauth

                                        @guest('player') 
                                            <h5>{{$player->surname}}</h5>
                                        @endguest
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-xs-6">
                                    <label for="email">
                                        <h4>E-mail</h4>
                                    </label>
                                    <div class="alert alert-info" for="last_name">
                                        @auth('player')
                                        @if(Auth::user()->id == $player->id)
                                            <input type="text" class="form-control" value="{{$player->email}}" name="email" required>
                                        @else
                                            <h5>{{$player->email}}</h5>
                                        @endif
                                        @endauth

                                        @guest('player')
                                            <h5>{{$player->email}}</h5>
                                        @endguest
                                    </div>
                                </div>
                            </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-4 ml-4">
                <div class="tab-content">
                    <div class="tab-pane active" id="home">
                        <div class="form-group">
                            <div class="col-xs-6">
                                <p>
                                    <h4>Pol</h4>
                                </p>

                                <div class="alert alert-info" for="last_name">
                                    @auth('player')
                                    @if(Auth::user()->id == $player->id)
                                        <select class="form-control" name="gender" required>
                                            <option value="{{$player->gender}}" selected>{{$player->gender}}</option>
                                            <option value="Musko">Musko</option>
                                            <option value="Zensko">Zensko</option>
                                        </select>
                                    @else
                                        <h5>{{$player->gender}}</h5>
                                    @endif
                                    @endauth

                                    @guest('player')
                                        <h5>{{$player->gender}}</h5>
                                    @endguest

                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-xs-6">
                                <label for="datum_rodjenja">
                                    <h4>Datum rodjenja</h4>
                                </label>
                                <br>
                                <div class="alert alert-info" for="last_name">
                                    @auth('player')
                                    @if(Auth::user()->id == $player->id)
                                        <input type="date" class="form-control" value="{{$player->birth_date}}" name="birth_date" required>
                                    @else
                                        <h5>{{$player->birth_date}}</h5>
                                    @endif
                                    @endauth

                                    @guest('player')
                                        <h5>{{$player->birth_date}}</h5>
                                    @endguest
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-xs-6">
                                <label for="datum_rodjenja">
                                    <h4>Klub</h4>
                                </label>
                                <div class="alert alert-info"> 
                                    @php
                                    $ime_kluba = "";
                                    $veza = DB::table('club_player')->where('player_id','=',$player->id)->first();
                                    if($veza == null)
                                    {
                                        $ime_kluba = "Igrac nije uclanjen ni u jedan klub.";
                                    } 
                                    else 
                                    {
                                    $klub = DB::table('clubs')->where('id','=',$veza->club_id)->first();
                                    if($klub == null)
                                    {
                                        $ime_kluba = "Greska!";
                                    }
                                    else 
                                    {
                                        $ime_kluba = $klub->name;    
                                    }
                                    }

                                    @endphp
                                    <h5>{{$ime_kluba}}</h5>
                                </div>
                            </div>
                        </div>
                        
                        @auth('player')
                        @if(Auth::user()->id == $player->id)
                        <div class="form-group">
                            <div class="col-xs-6">
                                <input type="submit" class="btn btn-primary" value="Azuriraj podatke">
                            </div>
                        </div>
                        @endif
                        @endauth
                </form>
                        @auth('club')
                        <div class="form-group">
                            <div class="col-xs-6">
                                @php
                                    $in_club = false;
                                    $igrac = null;
                                    $veze =  DB::table('club_player')->where('club_id','=',Auth::guard('club')->user()->id)->get();
                                    foreach($veze as $veza)
                                    {
                                        if($veza->left == null)
                                            $in_club = true;
                                    }
                                    if($in_club == true) 
                                        $igrac = DB::table('players')->where('id','=',$veza->player_id)->first();
                                @endphp

                                @if($igrac != null && $player->id == $igrac->id)
                                    <form action="/klub/dajOtkazIgracu" method="POST">
                                        @csrf
                                        <input type="hidden" name="club_id" value="{{Auth::guard('club')->user()->id}}">
                                        <input type="hidden" name="player_id" value="{{$player->id}}" >
                                        <input type="submit" class="btn btn-primary text-white" value="Daj otkaz igracu">
                                    </form>
                                @else
                                    <form action="/klub/posaljiZahtevIgracu" method="POST">
                                        @csrf
                                        <input type="hidden" name="club_id" value="{{Auth::guard('club')->user()->id}}">
                                        <input type="hidden" name="player_id" value="{{$player->id}}" >
                                        <input type="submit" class="btn btn-primary text-white" value="Posalji zahtev za uclanjenje">
                                    </form>
                                @endif
                            </div>
                        </div>
                        @endauth
                        
                        @auth('admin')
                        <div class="form-group">
                            <div class="col-xs-6">
                                <a href="/igrac/sudija/{{$player->id}}" class="btn btn-success text-white">Unapredi u sudiju</a>
                            </div>
                        </div>
                        @endauth
                    </div>

                </div>
            </div>
    
        </div>
    </div>
     
    @error('error')
        <div class="alert alert-danger alert-dismissible fade show">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            {{$message}}
        </div>
    @enderror

    @error('success')
    <div class="alert alert-success alert-dismissible fade show">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        {{$message}}
    </div>
@enderror

@endsection