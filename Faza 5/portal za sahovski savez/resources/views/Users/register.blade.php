@extends('master')
@section('title', 'Registracija');
@section('content')
<div class="container">
	<h1>Registracija</h1>
	<form action="/korisnici/registracija" method="POST">
		@csrf	
		<div class="form-group">
			<label for="name" class="label-form">Ime</label>
			<input type="text" class="form-control" name="name" required/>
		</div>
		<div class="form-group">
			<label for="name" class="label-form">Prezime</label>
			<input type="text" class="form-control" name="surname" required/>
		</div>
		<div class="form-group">
			<label for="birth_date" class="label-form">Datum rodjenja</label>
			<input type="date" class="form-control" name="birth_date" required/>
		</div>
		<div class="form-group">
			<label for="email" class="label-form">Email</label>
			<input type="email" class="form-control" name="email" required/>
		</div>

		<div class="form-group">
			<label for="password" class="label-form">Lozinka</label>
			<input type="password" class="form-control" name="password" required/>
		</div>
		<div class="form-group">
			<label for="confirmPassword" class="label-form">Potvrda lozinke</label>
			<input type="password" class="form-control" name="confirmPassword" required/>
		</div>

		<div class="form-group">
			<input type="submit" class="btn btn-primary"/>
		</div>
	</form>
</div>
@endsection