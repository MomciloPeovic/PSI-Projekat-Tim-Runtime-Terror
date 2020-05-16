@extends('master')

@section('title', $tournament->name)

@section('content')

<script>

var round = 1;

function loadResults(){
$.ajax({
	type: "GET",
	url: "/turnir/{{$tournament->id}}/rezultati",
	data: {
		round: round
	},
	success: function (data) {
		console.log('radi');
		document.getElementById("rezultati").innerHTML = data;
		loadNames();
		return;
	},
	error: function (data) {
		console.log('ne radi');
		return;
	},
});
}

var str = "{{json_encode($tournament->participants()->select('id', 'name', 'surname')->get())}}";
var participants = JSON.parse(str.replace(/&quot;/g,'"'));

function playerSelected(selected){
	const index = participants.findIndex(item => item.id == selected.value);
	if (index > -1) {
	participants.splice(index, 1);
	loadNames();
	}
}

function loadNames(){
	let emptyOption = document.createElement('option');
	emptyOption.value = 0;
	emptyOption.innerHTML = "Izaberite igraca";
	
	const whites = document.getElementsByClassName("white");
	const blacks = document.getElementsByClassName("black");

	for(let j = 0; j < whites.length; j++){
		if(whites[j].value == 0){
			whites[j].innerHTML = "";
			whites[j].appendChild(emptyOption.cloneNode(true));
		}
	}

	for(let j = 0; j < blacks.length; j++){
		if(blacks[j].value == 0){
			blacks[j].innerHTML = "";
			blacks[j].appendChild(emptyOption.cloneNode(true));
		}
	}

	for(let i = 0; i < participants.length; i++)
	{
		let option = document.createElement('option');
		option.innerHTML = participants[i].name + " " + participants[i].surname;
		option.value = participants[i].id;


		for(let j = 0; j < whites.length; j++){
			whites[j].appendChild(option.cloneNode(true));
		}
		for(let j = 0; j < blacks.length; j++)	
			blacks[j].appendChild(option.cloneNode(true));
	}
}

function selectRound()
{
	round = document.getElementById("round").value;
	loadResults();
}

function addRow()
{
	let row = document.createElement('tr');
	let td1 = document.createElement('td');
	let td2 = document.createElement('td');
	let td3 = document.createElement('td');
	let td4 = document.createElement('td');
	let option = document.createElement('option');
	option.value = 0;
	option.innerHTML = "Izaberite igraca";
	
	let whiteSelect = document.createElement('select');
	whiteSelect.appendChild(option);
	whiteSelect.classList.add("white");
	whiteSelect.name = "white[]"/* + document.getElementById('rezultati').childElementCount + "]"*/;
	whiteSelect.onchange = function() {playerSelected(this)};
	td2.appendChild(whiteSelect);
	
	let blackSelect = document.createElement('select');
	blackSelect.appendChild(option.cloneNode(true));
	blackSelect.classList.add("black");
	blackSelect.name = "black[]"/* + document.getElementById('rezultati').childElementCount + "]"*/;
	blackSelect.onchange = function() {playerSelected(this)};
	td4.appendChild(blackSelect);

	let resultSelect = document.createElement('select');
	let whiteWin = document.createElement('option');
	whiteWin.value = 2;
	whiteWin.innerHTML = "1:0";
	let draw = document.createElement('option');
	draw.value = 2;
	draw.innerHTML = "0.5:0.5";
	let blackWin = document.createElement('option');
	blackWin.value = 2;
	blackWin.innerHTML = "0:1";

	resultSelect.name = "result[]";
	resultSelect.appendChild(whiteWin);
	resultSelect.appendChild(draw);
	resultSelect.appendChild(blackWin);

	td3.appendChild(resultSelect);

	td1.innerHTML = document.getElementById('rezultati').childElementCount + 1;

	row.appendChild(td1);
	row.appendChild(td2);
	row.appendChild(td3);
	row.appendChild(td4);
	document.getElementById('rezultati').appendChild(row);

	loadNames();
}

</script>



<h1>Unos rezultata - {{ $tournament->name }}</h1>


<button onclick="addRow()" class="btn btn-primary mb-2">Dodaj rezultat</button>

<form action="/turnir/{{$tournament->id}}/unosRezultata" method="POST" >
	@csrf

	<select name="round" id="round" onchange="selectRound()">
		@for($i = 1; $i <= $tournament->rounds; $i++)
		<option value="{{$i}}">{{$i}}</option>
		@endfor
	</select>

	<table class="table table-hover w-75 text-center" onload="loadResults()">
		<thead class="thead-dark">
			<tr>
				<th scope="col">#</th>
				<th class="w-30" scope="col">Beli</th>
				<th scope="col">Rezultat</th>
				<th class="w-30" scope="col">Crni</th>
			</tr>
		</thead>

		<tbody id="rezultati">
			
			
		</tbody>
	</table>
	<input type="submit" value="Potvrdi" class="btn btn-success">

</form>	


	

@endsection