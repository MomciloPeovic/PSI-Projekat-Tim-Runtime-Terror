@extends('master')
@section('title','Klubovi')
@section('content')

<h1> Klubovi </h1>
    
        <div class="row">
          <div class="col-xl-4 mt-2">
            <p>Filter</p>
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

          <table class="table table-hover col-xl-8 mt-5">
            <thead class="thead-dark">
              <tr>
                <th scope="col">#</th>
                <th scope="col">Naziv</th>
                <th scope="col">Broj clanova</th>
                <th scope="col">Rejting</th>
                <th scope="col" class="igrac">Vise</th>
                
                @auth('player') 
				        	<th scope="col" class="igrac">Posalji zahtev</th>
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
            </tr>
            @endforeach

            </tbody>
          </table>
        </div>
    


@endsection