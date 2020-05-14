@extends('master')
@section('title','Klubovi')
@section('content')

<h1> Klubovi </h1>
    
        <div class="row">
          <div class="col-xl-4">
            <div class="card">
              <article class="card-group-item">
                <header class="card-header">
                  <h6 class="title">Naziv </h6>
                </header>
                <div class="filter-content">
                  <div class="card-body">
                    <input type="text" class="form-control">

                  </div> <!-- card-body.// -->
                </div>
              </article> <!-- card-group-item.// -->

              <article class="card-group-item">
                <header class="card-header">
                  <h6 class="title">Opstina </h6>
                </header>
                <div class="filter-content">
                  <div class="card-body">
                    <input type="text" class="form-control">

                  </div> <!-- card-body.// -->
                </div>
              </article> <!-- card-group-item.// -->

              <article class="card-group-item">
                <header class="card-header">
                  <h6 class="title">Datum osnivanja</h6>
                </header>
                <div class="filter-content">
                  <div class="card-body">
                    <div class="form-row">
                      <div class="form-group col-md-6">
                        <label>Od</label>
                        <input type="date" class="form-control">
                      </div>
                      <div class="form-group col-md-6 text-right">
                        <label>Do</label>
                        <input type="date" class="form-control">
                      </div>
                    </div>
                  </div> <!-- card-body.// -->
                </div>
              </article> <!-- card-group-item.// -->
            </div>
          </div>

          <table class="table table-hover col-xl-8">
            <thead class="thead-dark">
              <tr>
                <th scope="col">#</th>
                <th scope="col">Naziv</th>
                <th scope="col">Broj clanova</th>
                <th scope="col">Rejting</th>
                <th scope="col" class="igrac">Vise</th>
                
                @auth('player') 
                  @php
                  $in_club = false;
                  $id = Auth::user()->id;

                  if(DB::table('club_player')->where('player_id',"=", $id)->first() == null)
                    $in_club = false;
                  else $in_club = true;

                  @endphp
                  @if ($in_club == false)
                  <th scope="col" class="igrac">Posalji zahtev</th>
                  @endif

			        	@endauth 

              </tr>
            </thead>
          <tbody>

            @foreach($clubs as $club)
            <tr>
                <td>{{ $loop->index + 1 }}</td>                
                <td>{{ $club->name }}</td>
                <td> {{ 0 }} </td>         
                <td>{{ $club->rating }}</td>
                <td><a class="btn btn-primary" href="klub/{{ $club->id }}">+</a></td>
                @auth('player') 
                @php
                $id =  Auth::user()->id;
                @endphp
                @if($in_club == false)
                <td>
                  <form action='/igrac/zahtev_za_klub' method="POST">
                    @csrf
                    <input type="hidden" name="club_id" value="{{$club->id}}">
                    <input type="hidden" name="player_id" value="{{$id}}">
                    <input type="submit" class="btn btn-primary" value="+">
                  </form>
                </td>
                @endif
                @endauth 
            </tr>
            @endforeach

            </tbody>
          </table>
        </div>
    


@endsection