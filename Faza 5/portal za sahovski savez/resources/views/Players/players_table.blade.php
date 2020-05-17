
@foreach ($players as $player)
    <tr>
        <td class = "col-xl-1">{{$loop->index + 1}}</td> 
        <td class = "col-xl-3">{{$player->name}}</td>  
        <td class = "col-xl-3">{{$player->surname}}</td>  
        <td class = "col-xl-2">{{$player->rating}}</td>  
        <td class = "col-xl-1"><a class="btn btn-primary" href="/igrac/{{ $player->id }}">+</a></td> 
    </tr>
@endforeach

<tr>
    <td colspan="5">
    <ul class="pagination justify-content-center">
    @for($i = 1; $i< $broj_stranica + 1;$i++)
        <li class="page-item"><button class="page-link"  onclick="prikazi_igrace({{$i}})">{{$i}}</button></li>
    @endfor
    </ul>
    </td>
</tr>