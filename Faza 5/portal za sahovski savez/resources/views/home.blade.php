@extends('master')
@section('title','HomePage')
@section('content')

    <h1>Doborodosli</h1>
    <br>
    <a href="{{action('PlayerController@show')}}">Igraci</a>
@endsection
