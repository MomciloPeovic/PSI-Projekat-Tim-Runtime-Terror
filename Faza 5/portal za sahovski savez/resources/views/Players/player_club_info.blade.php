@extends('master')
@section('title','Informacije o klubu')
@section('content')

@php

$uclanjen = true;
$veza = DB::table('club_player')->where('player_id','=',$player->id)->first();

if($veza == null)
    $uclanjen = false;

@endphp
@if($uclanjen == false)

<h4 class="mt-5" align="center">Trenutno niste uclanjeni ni u jedan klub.</h4>

@else

@php
    $klub = DB::table('clubs')->where('id','=',$veza->club_id)->first();
@endphp

<p class="display-4 text-center">Moj klub</p>
        <table class="table">
            <thead class="thead-dark">
              <tr>
                <th scope="col"></th>
                <th scope="col"></th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <th scope="row">Naziv kluba</th>
                <td>{{$klub->name}}</td>

              </tr>
              <tr>
                <th scope="row">Datum osnivanja</th>
                <td>{{$klub->founded}}</td>

              </tr>
              <tr>
                <th scope="row">Kucni telefon</th>
                <td>{{$klub->phone}}</td>
              </tr>
              <tr>
                <th scope="row">Email</th>
                <td>{{$klub->email}}</td>
              </tr>

              <tr>
                <th scope="row">Adresa</th>
                <td>{{$klub->address}}</td>
              </tr>
            </tbody>
          </table>
          
    
          <div class="row justify-content-end">
          <a  href="/igrac/napusti_klub/{{$player->id}}" class="btn btn-danger">Napusti klub</a>        
        </div>
@endif

@endsection