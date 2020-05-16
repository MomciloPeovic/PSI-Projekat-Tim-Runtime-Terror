@extends('master')
@section('title','Obavestenja')
@section('content')


<h1> Vasa Obavestenja</h1>
<br><br>
@foreach($notifications as $notification)

@php
    $player = DB::table('players')->where('id','=',$notification->player_id)->first();
@endphp    

@if($notification->expiry_date >= date('Y-m-d'))
<div class="alert alert-info" role="alert">
    <div class = "row">
        <div class = "col-sm-8">
            "{{$player->name}}" Vam je poslao zahtev za uclanjenje u klub!
        </div>
        <div class = "col-sm-2">
            <form action="" method="POST" class="form-inline">
                <input type="hidden" name="club_id" value="{{$notification->club_id}}"> 
                <input type="hidden" name="player_id" value="{{$notification->player_id}}"> 
                <input type="submit" class="btn btn-success" value="Prihvati">
            </form>
        </div>
        <div class = "col-sm-2">
            <form action="" method="POST" class="form-inline"> 
                <input type="hidden" name="club_id" value="{{$notification->club_id}}"> 
                <input type="hidden" name="player_id" value="{{$notification->player_id}}">
                <input type="submit" class="btn btn-danger" value="Odbij">
            </form>
        </div>
    </div>
</div>
@else 
<div class="alert alert-info" role="alert">
    <div class = "row">
        <div class = "col-sm-10">
            "{{$player->name}}" Vam je posalo zahtev za uclanjenje, medjutim poziv je istekao datuma {{$notification->expiry_date}}. &nbsp;
        </div>
        <div class = "col-sm-2">
            <form action="" method="POST">
                <input type="hidden" name="player_id" value="{{$notification->player_id}}"> 
                <input type="hidden" name="club_id" value="{{$notification->club_id}}"> 
                <input type="submit" class="btn btn-primary" value="X">
            </form>
        </div>
    </div>
</div>
@endif

@endforeach


@endsection