@extends('master')
@section('title', 'Registracija')

@section('content')

<h1>Registracija</h1>
<div class="row">
	<form class="col-8" action="/korisnici/registracija" method="POST">
		@csrf	
		<div class="form-group">
			<label for="name" class="label-form">Ime</label>
			<input type="text" class="form-control" name="name" required/>
			@error('name')
			<span class="text-danger">{{ $message }}</span>
			@enderror
		</div>
		<div class="form-group">
			<label for="name" class="label-form">Prezime</label>
			<input type="text" class="form-control" name="surname" required/>
			@error('surname')
			<span class="text-danger">{{ $message }}</span>
			@enderror
		</div>
		<div class="form-group">
			<label for="birth_date" class="label-form">Datum rodjenja</label>
			<input type="date" class="form-control" name="birth_date" required/>
			@error('birth_date')
			<span class="text-danger">{{ $message }}</span>
			@enderror
		</div>
		<div class="form-group">
			<label for="email" class="label-form">Email</label>
			<input type="email" class="form-control" name="email" required/>
			@error('email')
			<span class="text-danger">{{ $message }}</span>
			@enderror
		</div>

		<div class="form-group">
			<label for="password" class="label-form">Lozinka</label>
			<input type="password" class="form-control" name="password" required/>
			@error('password')
			<span class="text-danger">{{ $message }}</span>
			@enderror
		</div>
		<div class="form-group">
			<label for="confirmPassword" class="label-form">Potvrda lozinke</label>
			<input type="password" class="form-control" name="confirmPassword" required/>
			@error('confirmPassword')
			<span class="text-danger">{{ $message }}</span>
			@enderror
		</div>

		<div class="form-group">
			<input type="submit" value="Registracija" class="btn btn-primary"/>
		</div>
	</form>
</div>
@endsection