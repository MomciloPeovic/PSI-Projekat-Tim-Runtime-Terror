@extends('master')

@section('title', 'naslov')

@section('content')

<div class="row">
	<form class="col-6" action="/korisnici/login" method="POST">
		@csrf
		<div class="form-group">
			<label for="email" class="label-form">Email</label>
			<input type="email" class="form-control" id="email" name="email"/>
		</div>

		<div class="form-group">
			<label for="password" class="label-form">Password</label>
			<input type="password" class="form-control" id="password" name="password"/>
		</div>

		<div class="form-group">
			<input type="submit" value="Log in">
		</div>
	</form>
</div>

@endsection