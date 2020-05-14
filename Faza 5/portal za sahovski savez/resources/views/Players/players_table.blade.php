
@foreach ($players as $player)
<tr>
    <td>{{$loop->index + 1}}</td> 
    <td>{{$player->name}}</td>  
    <td>{{$player->surname}}</td>  
    <td>{{$player->rating}}</td>  
    <td><a class="btn btn-primary" href="igrac/{{ $player->id }}">+</a></td> 
</tr>
@endforeach