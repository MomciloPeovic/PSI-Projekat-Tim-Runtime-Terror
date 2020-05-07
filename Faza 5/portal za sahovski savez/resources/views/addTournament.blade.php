@extends('master')

@section('title', 'Dodavanje takmicenja')

@section('content')

<h1>Dodavanje takmicenja</h1>
<div class="row">
	<form class="col-4" action='/turnir/dodaj' method="POST">
		@csrf
		<div class="form-group">
			<label class="label-form">Naziv</label>
			<input type="text" class="form-control" name='name'>
		</div>

		<div class="form-group">
			<label class="label-form">Broj kola</label>
			<input type="number" class="form-control" name='rounds'>
		</div>

		<div class="form-group">
			<label class="label-form">Mesto</label>
			<input type="text" class="form-control" name='place'>
		</div>

		<div class="form-group">
			<label class="label-form">Datum</label>
			<input type="date" class="form-control" name='date'>
		</div>

		<div class="form-group">
			<label class="label-form">Vreme</label>
			<input type="time" class="form-control" name='time'>
		</div>

		<div class="form-group">
			<label class="label-form">Telefon</label>
			<input type="phone" class="form-control" name='phone'>
		</div>

		<div class="form-group">
			<label class="label-form">E-mail</label>
			<input type="email" class="form-control" name='email'>
		</div>

		<div class="form-group">
			<input type="submit" class="btn btn-primary">
		</div>
	</form>
</div>

@endsection