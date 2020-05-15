@foreach ($clubs as $club)
<tr>
    <td class = "col-xl-1"> {{$loop->index + 1}} </td> 
    <td class = "col-xl-3"> {{$club->name}} </td>  
    <td class = "col-xl-3"> {{0}} </td>  
    <td class = "col-xl-4"> {{$club->address}} </td>
    <td class = "col-xl-1"><a class="btn btn-primary" href="/klub/{{ $club->id }}">+</a></td> 
</tr>
@endforeach

<tr>
    <td colspan="5">
    <ul class="pagination justify-content-center">
    @for($i = 1; $i< $broj_stranica + 1;$i++)
        <li class="page-item"><button class="page-link"  onclick="prikazi_klubove({{$i}})">{{$i}}</button></li>
    @endfor
    </ul>
    </td>
</tr>