@for($i = 0; $i < ceil(sizeof($participants) / 2); $i++)
<tr>
	<td>{{$i + 1}}</td>
	<td>
		<select onchange="playerSelected(this)" name="white" class="white">
			<option value="0"></option>
		</select>
	</td>
	<td>
		<select>
			<option value="2">1:0</option>
			<option value="1">0.5:0.5</option>
			<option value="0">0:1</option>
		</select>
	</td>
	<td>
		<select onchange="playerSelected(this)" name="black" class="black">
			<option disabled selected value> -- select an option -- </option>
		</select>
	</td>
</tr>
@endfor