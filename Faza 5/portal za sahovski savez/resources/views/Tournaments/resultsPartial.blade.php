@foreach($results as $result)
<tr>
	<td>{{$result->table}}</td>
	<td>
		<select onchange="playerSelected(this)" name="white[]" class="white">
			<option value="{{$result->white->id}}">{{$result->white->name}} {{$result->white->surname}}</option>
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
			<option value="{{$result->black->id}}">{{$result->black->name}} {{$result->black->surname}}</option>
		</select>
	</td>
</tr>
@endforeach

<tr>
	<td>{{sizeof($results) + 1}}</td>
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
