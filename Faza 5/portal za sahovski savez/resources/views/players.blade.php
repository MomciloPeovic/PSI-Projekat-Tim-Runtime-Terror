@extends('master')
@section('title','Igraci')
@section('content')

    <h1>Igraci</h1>

    @foreach($players as $player)
    <p> {{ $player->name }}</p> <br>
    @endforeach
    <a href="{{action('HomeController@index')}}"> Nazad na pocetnu</a>
@endsection
