@extends('master')
@section('title','Turniri')
@section('content')
	<h1> Turniri </h1>

	@foreach($tournaments as $tournament)
		<p> {{ $tournament->name }}</p>
	@endforeach
@endsection