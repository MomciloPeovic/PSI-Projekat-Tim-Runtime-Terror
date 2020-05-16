@extends('master')
@section('title','Informacije o klubu')
@section('content')

<form action="/klub/dodaj" method="POST">
    @csrf
<div class="container-fluid mt-1 ml-5">
    <div id="klub-profil">
        <div class="row">
            <div class="col-sm-3">

                <div class="text-center">
                    <img src="http://ssl.gstatic.com/accounts/ui/avatar_2x.png" style="width: 500px"
                        class="avatar img-circle img-thumbnail" alt="avatar">
                    <div class="col-sm-12">
                        <h1>{{$club->name}}</h1>
                    </div>
                </div>
                <hr>
                <a href="/klub" class="badge badge-primary"> < Nazad</a>
            </div>
            <div class="col-sm-4">
                <div class="tab-content">
                    @auth('club')
                    @if(Auth::guard('club')->user()->id == $club->id)
                    <input type="hidden" name="id" value="{{Auth::guard('club')->user()->id}}">
                    @endif
                @endauth
                    <div class="tab-pane active" id="home">
                    
                            <div class="form-group">
                                <div class="col-xs-6">
                                    <label for="name">
                                        <h4>Naziv</h4>
                                    </label>
                                    <div class="alert alert-info" for="name">
                                        @auth('club')
                                        @if(Auth::guard('club')->user()->id == $club->id)
                                            <input type="text" class="form-control" value="{{$club->name}}" name="name" required>
                                        @else
                                            <h5>{{$club->name}}</h5>
                                        @endif
                                        @endauth

                                        @guest('club')
                                            <h5>{{$club->name}}</h5>
                                        @endguest
                                    </div>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <div class="col-xs-6">
                                    <label for="email">
                                        <h4>E-mail</h4>
                                    </label>
                                    <div class="alert alert-info" for="email">
                                        @auth('club')
                                        @if(Auth::guard('club')->user()->id == $club->id)
                                            <input type="text" class="form-control" value="{{$club->email}}" name="email" required>
                                        @else
                                            <h5>{{$club->email}}</h5>
                                        @endif
                                        @endauth

                                        @guest('club')
                                            <h5>{{$club->email}}</h5>
                                        @endguest
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-xs-6">
                                    <label for="address">
                                        <h4>Adresa</h4>
                                    </label>
                                    <div class="alert alert-info" for="address">
                                        @auth('club')
                                        @if(Auth::guard('club')->user()->id == $club->id)
                                            <input type="text" class="form-control" value="{{$club->address}}" name="address" required>
                                        @else
                                            <h5>{{$club->address}}</h5>
                                        @endif
                                        @endauth

                                        @guest('club')
                                            <h5>{{$club->address}}</h5>
                                        @endguest
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="tab-content">
                        <div class="tab-pane active" id="home">
                            <div class="form-group">
                                <div class="col-xs-6">
                                    <label for="phone">
                                        <h4>Telefon</h4>
                                    </label>
                                    <div class="alert alert-info" for="phone">
                                        @auth('club')
                                        @if(Auth::guard('club')->user()->id == $club->id)
                                            <input type="text" class="form-control" value="{{$club->phone}}" name="phone" required>
                                        @else
                                            <h5>{{$club->phone}}</h5>
                                        @endif
                                        @endauth

                                        @guest('club')
                                            <h5>{{$club->phone}}</h5>
                                        @endguest
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-xs-6">
                                    <label for="founded">
                                        <h4>Datum osnivanja </h4>
                                    </label>
                                    <br>
                                    <div class="alert alert-info" for="founded"><label id="founded" name="founded">
                                        @auth('club')
                                            @if(Auth::guard('club')->user()->id == $club->id)
                                                <input type="date" class="form-control" value="{{$club->founded}}" name="founded" required>
                                            @else
                                                <h5>{{$club->founded}}</h5>
                                            @endif
                                            @endauth

                                            @guest('club')
                                                <h5>{{$club->founded}}</h5>
                                            @endguest
                                    </label></div>
                                </div>
                            </div>

                            @auth('club')
                            @if(Auth::guard('club')->user()->id == $club->id)
                            <div class="form-group">
                                <div class="col-xs-6">
                                    <input type="submit" class="btn btn-primary" value="Azuriraj podatke">
                                </div>
                            </div>
                            @endif
                            @endauth
                </div>
            </div>
        </div>
    </form>

@endsection