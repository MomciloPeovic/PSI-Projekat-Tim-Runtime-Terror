@foreach ($tournaments as $tournament)
    <tr>
        <td class = "col-xl-1">{{$loop->index + 1}}</td> 
        <td class = "col-xl-3">{{$tournament->name}}</td>  
        <td class = "col-xl-3">{{$tournament->place}}</td>
        <td class = "col-xl-3">{{$tournament->rounds}}</td>    
        <td class = "col-xl-3">{{$tournament->start_date}}</td>  
        <td class = "col-xl-3">{{$tournament->end_date}}</td>  
        <td class = "col-xl-1"><a class="btn btn-primary" href="/turnir/{{ $tournament->id }}">+</a></td> 
    </tr>
@endforeach

<tr>
    <td colspan="7">
    <ul class="pagination justify-content-center">
    @for($i = 1; $i< $number_of_pages + 1;$i++)
        <li class="page-item"><button class="page-link"  onclick="prikazi_turnire({{$i}})">{{$i}}</button></li>
    @endfor
    </ul>
    </td>
</tr>