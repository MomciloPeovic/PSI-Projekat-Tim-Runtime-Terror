@extends('master')
@section('title','Informacije o igracu')
@section('content')

<div class="container-fluid mt-1 ml-5">
<div id="igrac-profil">
    <div class="row">
        <div class="col-sm-3">

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
        <div class="col-sm-4">
            <div class="tab-content">
                <div class="tab-pane active" id="home">

                
                        <div class="form-group">
                            <div class="col-xs-6">
                                <label for="first_name">
                                    <h4>Ime</h4>
                                </label>
                                <div class="alert alert-info" for="first_name">
                                    <h5>{{$player->name}}</h5>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-6">
                                <label for="last_name">
                                    <h4>Prezime</h4>
                                </label>
                                <div class="alert alert-info" for="last_name">
                                    <h5>{{$player->surname}}</h5>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-xs-6">
                                <label for="phone">
                                    <h4>Kucni telefon</h4>
                                </label>
                                <div class="alert alert-info" for="last_name">
                                    <h5>??</h5>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-xs-6">
                                <label for="mobile">
                                    <h4>Mobilni telefon</h4>
                                </label>
                                <div class="alert alert-info" for="last_name">
                                    <h5>??</h5>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-xs-6">
                                <label for="email">
                                    <h4>E-mail</h4>
                                </label>
                                <div class="alert alert-info" for="last_name">
                                    <h5>{{$player->email}}</h5>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-xs-6">
                                <label for="email">
                                    <h4>Adresa</h4>
                                </label>
                                <div class="alert alert-info" for="last_name">
                                    <h5>??</h5>
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

                            <div class="alert alert-info" for="last_name"><label for="male">
                                    <h5>??</h5>
                                </label><br></div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-xs-6">
                            <label for="datum_rodjenja">
                                <h4>Datum rodjenja</h4>
                            </label>
                            <br>
                            <div class="alert alert-info" for="last_name"><label id="datum_rodjenja"
                                    name="datum_rodjenja">
                                <h5>{{$player->birth_date}}</h5>
                                </label></div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-xs-6">
                            <label for="datum_rodjenja">
                                <h4>Klub</h4>
                            </label>
                            <div class="alert alert-info"> <h5>??</h5></label></div>
                        </div>
                    </div>
                  
                </div>
            </div>
        </div>
    </div>
</div>

@endsection