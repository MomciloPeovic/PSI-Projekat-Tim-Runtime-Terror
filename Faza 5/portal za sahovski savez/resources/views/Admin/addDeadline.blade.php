@extends('master')

@section('title', 'Dodavanje takmicenja')

@section('content')

<h1>Dodavanje prelaznog roka</h1>
<div class="row">
    <form class="col-xl-8" action='/dodajRok' method="POST">

        @csrf
        <div class="form-group">
            <label class="label-form">Datum pocetka</label>
            <input type="date" class="form-control" name='start'>
        </div>

        <div class="form-group">
            <label class="label-form">Datum zavrsetka</label>
            <input type="date" class="form-control" name='end'>
        </div>

        <div class="form-group">
			<input type="submit" class="btn btn-primary" value="Potvrdi">
		</div>
    </form>
</div>

@endsection