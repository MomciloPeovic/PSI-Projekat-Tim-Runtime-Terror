@extends('master')

@section('title', $tournament->name)

@section('content')

<script>

var round = 0;

$.ajax({
	type: "POST",
	url: "/turnir/{{$tournament->id}}/rezultati",
	data: {
		_token:'<?php echo csrf_token();?>',
		round: round
	},
	success: function (data) {
		console.log('radi');
		document.getElementById("rezultati").innerHTML = data;
		return;
	},
	error: function (data) {
		console.log('ne radi');
		return;
	},
});

var str = "{{json_encode($tournament->participants()->select('id', 'name', 'surname')->get())}}";
var participants = JSON.parse(str.replace(/&quot;/g,'"'));

function playerSelected(selected){
	const index = participants.findIndex(item => item.id == selected.value);
	alert(index);
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

</script>



<h1>Unos rezultata - {{ $tournament->name }}</h1>


<select>
	@for($i = 1; $i <= $tournament->rounds; $i++)
	<option value="{{$i}}">{{$i}}</option>
	@endfor
</select>

<table class="table table-hover w-75 text-center">
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


	

@endsection