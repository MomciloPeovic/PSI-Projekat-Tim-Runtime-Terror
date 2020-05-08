@extends('master')
@section('title', 'Dodavanje igraca')

@section('content')
<h1>Dodavanje igraca</h1>
<div class="row ml-3">
	<form class="col-4" action='/igrac/dodaj' method="POST">
		@csrf
        <div class="form-group">
			<label class="label-form">Ime</label>
			<input type="text" class="form-control" name='name' required>
        </div>
        <div class="form-group">
			<label class="label-form">Prezime</label>
			<input type="text" class="form-control" name='surname' required>
        </div>
        <div class="form-group">
			<label class="label-form">Email</label>
			<input type="email" class="form-control" name='email' required>
        </div>
        <div class="form-group">
			<label class="label-form">Lozinka</label>
			<input type="password" class="form-control" name='password' required>
        </div>
        <div class="form-group">
			<label class="label-form">Datum rodjenja</label>
			<input type="date" class="form-control" name='birth_date' required>
        </div>
        <div class="form-group">
			<label class="label-form">Rejting</label>
			<input type="text" class="form-control" name='rating' required>
        </div>

        <div class="form-group">
			<input type="submit" class="btn btn-primary" value="Dodaj">
		</div>
    </form>
@endsection