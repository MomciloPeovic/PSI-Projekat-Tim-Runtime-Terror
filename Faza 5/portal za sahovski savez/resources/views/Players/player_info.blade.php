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

                        @auth('club')
                        @php
                            //TODO(Nikola) : bolja provera da li je igrac u klubu 
                            $u_klubu = false;
                            $veze =  DB::table('club_player')->where('player_id','=',$player->id)->get();
                            foreach($veze as $veza)
                            {
                                if($veza->left == null)
                                    $u_klubu = true;
                            }

                            $player_id = $player->id;
                            $club_id = Auth::guard('club')->user()->id;
                        @endphp
                        @if($u_klubu == false)
                        <div class="form-group">
                            <div class="col-xs-6">
                                <a href="/klub/{{$club_id}}/posaljiZahtevIgracu/{{$player_id}}" class="btn btn-primary text-white">Posalji zahtev za uclanjenje</a>
                            </div>
                        </div>
                        @endif
                        @endauth

                    </div>

                </div>
            </div>
    
        </div>
    </div>
</form>

@endsection