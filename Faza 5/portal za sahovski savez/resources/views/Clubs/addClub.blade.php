@extends('master')
@section('title', 'Dodavanje kluba')
@section('content')

<h1>Dodavanje kluba</h1>
<div class="row">
	<form class="col-xl-8" action='/klub/dodaj' method="POST">
		
		@csrf
		<div class="form-group">
			<label class="label-form">Naziv</label>
			<input type="text" class="form-control" name='name'>
		</div>

		<div class="form-group">
			<label class="label-form">Email</label>
            <input type="text" class="form-control" name='email'>
		</div>

		<div class="form-group">
			<label class="label-form">Lozinka</label>
			<input type="password" class="form-control" name='password'>
		</div>

		<div class="form-group">
			<label class="label-form">Founded</label>
			<input type="text" class="form-control" name='founded'>
		</div>

		<div class="form-group">
			<label class="label-form">Adresa</label>
			<input type="date" class="form-control" name='address'>
		</div>

		<div class="form-group">
			<label class="label-form">Telefon</label>
			<input type="phone" class="form-control" name='phone'>
		</div>

		<div class="form-group">
			<input type="submit" class="btn btn-primary" value="Potvrdi">
		</div>
	</form>
</div>
@endsection