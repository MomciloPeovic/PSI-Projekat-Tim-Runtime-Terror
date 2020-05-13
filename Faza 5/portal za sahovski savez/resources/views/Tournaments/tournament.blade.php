@extends('master')

@section('title', $tournament->name)

@section('content')

<h1> {{ $tournament->name }}</h1>

	<ul class="nav nav-tabs nav-fill mt-3" id="myTab" role="tablist">
		<li class="nav-item">
			<a class="nav-link active" id="tabela-tab" data-toggle="tab" href="#tabela" role="tab"
				aria-controls="tabela" aria-selected="true">Tabela</a>
		</li>
		<li class="nav-item">
			<a class="nav-link" id="rezultati-id" data-toggle="tab" href="#rezultati" role="tab"
				aria-controls="rezultati" aria-selected="false">Rezultati</a>
		</li>
		<li class="nav-item">
			<a class="nav-link" id="spisak-tab" data-toggle="tab" href="#spisak" role="tab" aria-controls="spisak"
				aria-selected="false">Spisak igraca</a>
		</li>
	</ul>
	<div class="tab-content" id="myTabContent">

		<!-- Tabela TAB -->
		<div class="tab-pane fade show active p-5" id="tabela" role="tabpanel" aria-labelledby="tabela-tab">
			<div class="container-fluid mt-1 ml-5">
				<h1 class="h1">Tabela</h1>
				<table class="table table-hover w-75 text-center">
					<thead class="thead-dark">
						<tr>
							<th scope="col">#</th>
							<th scope="col">Ime i prezime</th>
							<th scope="col">Poeni</th>
						</tr>
					</thead>

					<tbody>
						@foreach($tournament->participants as $participant)
						<tr>
							<th scope="row">1.</th>
							<td>{{ $participant->name }} @if($tournament->type='player') {{$participant->surname }} @endif</td>
							<td>0</td>
						</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>

		<!-- Rezultati tab -->
		<div class="tab-pane fade p-5" id="rezultati" role="tabpanel" aria-labelledby="rezultati-tab">
			<div class="container-fluid mt-1 ml-5">
				<h2 class="h2">Rezultati</h2>
				<h3 class="h3">1. Kolo</h3>
				<table class="table table-hover w-75 text-center">
					<thead class="thead-dark">
						<tr>
							<th scope="col">#</th>
							<th class="w-30" scope="col">Beli</th>
							<th scope="col">Poeni</th>
							<th scope="col">Rezultat</th>
							<th class="w-30" scope="col">Crni</th>
							<th scope="col">Poeni</th>
						</tr>
					</thead>

					<tbody>
						<tr>
							<th scope="row">1.</th>
							<td class="w-30">Petar Petrovic</td>
							<td>7</td>
							<td>1:0</td>
							<td class="w-30">Marko Markovic</td>
							<td>3</td>
						</tr>

						<tr>
							<th scope="row">2.</th>
							<td class="w-30">Nikola Nikolic</td>
							<td>7</td>
							<td>1:0</td>
							<td class="w-30">Nemanja Nemanjic</td>
							<td>3</td>
						</tr>
					</tbody>
				</table>

				<h3 class="h3">2. Kolo</h3>
				<table class="table table-hover w-75 text-center">
					<thead class="thead-dark">
						<tr>
							<th scope="col">#</th>
							<th class="w-30" scope="col">Beli</th>
							<th scope="col">Poeni</th>
							<th scope="col">Rezultat</th>
							<th class="w-30" scope="col">Crni</th>
							<th scope="col">Poeni</th>
						</tr>
					</thead>

					<tbody>
						<tr>
							<th scope="row">1.</th>
							<td class="w-30">Marko Markovic</td>
							<td>3</td>
							<td>1:0</td>
							<td class="w-30">Petar Petrovic</td>
							<td>8</td>
						</tr>

						<tr>
							<th scope="row">2.</th>
							<td class="w-30">Nemanja Nemanjic</td>
							<td>2</td>
							<td>0.5:0.5</td>
							<td class="w-30">Nikola Nikolic</td>
							<td>7</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>

		<!-- Spisak igraca tab-->
		<div class="tab-pane fade p-5" id="spisak" role="tabpanel" aria-labelledby="spisak-tab">
			<div class="container-fluid mt-1 ml-5">
				<h1 class="h1">Spisak</h1>
				<table class="table table-hover w-75">
					<thead class="thead-dark">
						<tr>
							<th scope="col">#</th>
							<th scope="col">Ime i prezime</th>
							<th scope="col">Datum rodjenja</th>
							<th scope="col">Rejting</th>
						</tr>
					</thead>

					<tbody>
						@foreach($tournament->participants as $participant)
						<tr>
							@if($tournament->type='player')
							<th scope="row">{{ $loop->index }}</th>
							<td>{{ $participant->name }}  {{$participant->surname }}</td>
							<td>{{ date('d.m.Y.', strtotime($participant->birth_date)) }}</td>
							<td>{{ $participant->rating }}</td>
							 @endif
						</tr>
						@endforeach

						
					</tbody>
				</table>
			</div>
		</div>
	</div>

@endsection