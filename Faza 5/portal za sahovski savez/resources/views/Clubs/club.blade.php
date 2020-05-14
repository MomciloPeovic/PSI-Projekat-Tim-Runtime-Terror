@extends('master')
@section('title','Informacije o klubu')
@section('content')

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
                    <div class="tab-pane active" id="home">
                    
                            <div class="form-group">
                                <div class="col-xs-6">
                                    <label for="name">
                                        <h4>Naziv</h4>
                                    </label>
                                    <div class="alert alert-info" for="name">
                                        <h5>{{$club->name}}</h5>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <div class="col-xs-6">
                                    <label for="email">
                                        <h4>E-mail</h4>
                                    </label>
                                    <div class="alert alert-info" for="email">
                                        <h5>{{$club->email}}</h5>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-xs-6">
                                    <label for="address">
                                        <h4>Adresa</h4>
                                    </label>
                                    <div class="alert alert-info" for="address">
                                        <h5>{{$club->address}}</h5>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-xs-6">
                                    <label for="phone">
                                        <h4>Telefon</h4>
                                    </label>
                                    <div class="alert alert-info" for="phone">
                                        <h5>{{$club->phone}}</h5>
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
                                    <h5>{{$club->founded}}</h5>
                                    </label></div>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection