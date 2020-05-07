@extends('master')
@section('title','Igraci')
@section('content')

    <h1>Igraci</h1>

    {{$players}}
    <a href="{{action('HomeController@index')}}"> Nazad na pocetnu</a>
@endsection
