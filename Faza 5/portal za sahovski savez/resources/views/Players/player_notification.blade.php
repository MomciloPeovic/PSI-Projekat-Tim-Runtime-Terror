@extends('master')
@section('title','Obavestenja')
@section('content')


<h1> Vasa Obavestenja</h1>
<br><br>
@foreach($obavestenja as $obavestenje)

@php
    $klub = DB::table('clubs')->where('id','=',$obavestenje->club_id)->first();
@endphp    

@if($obavestenje->expiry_date >= date('Y-m-d'))
<div class="alert alert-info" role="alert">
    Klub "{{$klub->name}}" Vas je pozvao da se uclanite u klub!
    <form action="" method="POST" class="form-inline">
        <input type="hidden" name="player_id" value="{{$obavestenje->player_id}}"> 
        <input type="hidden" name="club_id" value="{{$obavestenje->club_id}}"> 
        <input type="submit" class="btn btn-success" value="Prihvati">
    </form>
    <form action="" method="POST" class="form-inline">
        <input type="hidden" name="player_id" value="{{$obavestenje->player_id}}"> 
        <input type="hidden" name="club_id" value="{{$obavestenje->club_id}}"> 
        <input type="submit" class="btn btn-danger" value="Odbij">
    </form>
</div>
@else 
<div class="alert alert-info" role="alert">
    Klub "{{$klub->name}}" Vas je pozvao da se uclanite u klub, medjutim poziv je istekao datuma {{$obavestenje->expiry_date}}. &nbsp;
    <form action="" method="POST">
        <input type="hidden" name="player_id" value="{{$obavestenje->player_id}}"> 
        <input type="hidden" name="club_id" value="{{$obavestenje->club_id}}"> 
        <input type="submit" class="btn btn-primary" value="X">
    </form>
</div>
@endif

@endforeach


@endsection