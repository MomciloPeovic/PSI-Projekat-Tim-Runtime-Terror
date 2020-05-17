@foreach($results as $result)
<tr>
	<td><input type="number" value="{{$result->table}}" name="table[]"></td>
	<td>
		<select onchange="playerSelected(this)" name="white[]" class="white">
			<option value="{{$result->white->id}}">{{$result->white->name}} {{$result->white->surname}}</option>
		</select>
	</td>
	<td>
		<select name="result[]">
			<option value="2" {{ $result->result == 2 ? "selected" : ""}}>1:0</option>
			<option value="1" {{ $result->result == 1 ? "selected" : ""}}>0.5:0.5</option>
			<option value="0" {{ $result->result == 0 ? "selected" : ""}}>0:1</option>
		</select>
	</td>
	<td>
		<select onchange="playerSelected(this)" name="black[]" class="black">
			<option value="{{$result->black->id}}">{{$result->black->name}} {{$result->black->surname}}</option>
		</select>
	</td>
</tr>
@endforeach

@if(sizeof($results) == 0)
<tr>
	<td><input type="number" value="{{sizeof($results) + 1}}" name="table[]"></td>
	<td>
		<select onchange="playerSelected(this)" name="white[]" class="white">
			<option value="0">Izaberite igraca</option>
		</select>
	</td>
	<td>
		<select name="result[]">
			<option value="2">1:0</option>
			<option value="1">0.5:0.5</option>
			<option value="0">0:1</option>
		</select>
	</td>
	<td>
		<select onchange="playerSelected(this)" name="black[]" class="black">
			<option value="0">Izaberite igraca</option>
		</select>
	</td>
</tr>
@endif