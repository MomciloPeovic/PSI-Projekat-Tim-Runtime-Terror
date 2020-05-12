@extends('master')
@section('title','Igraci')
@section('content')

    <h1>Igraci</h1>
    <div class="container">
        <div class="row">
          <div class="col-sm-3">
            <p>Filter</p>
            <div class="card">
              <article class="card-group-item">
                <header class="card-header">
                  <h6 class="title">Ime </h6>
                </header>
                <div class="filter-content">
                  <div class="card-body">
                    <input type="text" class="form-control">

                  </div> <!-- card-body.// -->
                </div>
              </article> <!-- card-group-item.// -->
              <article class="card-group-item">
                <header class="card-header">
                  <h6 class="title">Pol </h6>
                </header>
                <div class="filter-content">
                  <div class="card-body">
                    <label class="form-check">
                      <input class="form-check-input" type="radio" name="exampleRadio" value="">
                      <span class="form-check-label">
                        Musko
                      </span>
                    </label>
                    <label class="form-check">
                      <input class="form-check-input" type="radio" name="exampleRadio" value="">
                      <span class="form-check-label">
                        Zensko
                      </span>
                    </label>
                  </div> <!-- card-body.// -->
                </div>
              </article> <!-- card-group-item.// -->

              <article class="card-group-item">
                <header class="card-header">
                  <h6 class="title">Rejting</h6>
                </header>
                <div class="filter-content">
                  <div class="card-body">
                    <div class="form-row">
                      <div class="form-group col-md-6">
                        <label>Min</label>
                        <input type="number" class="form-control" id="inputEmail4" placeholder="0">
                      </div>
                      <div class="form-group col-md-6 text-right">
                        <label>Max</label>
                        <input type="number" class="form-control" placeholder="3000">
                      </div>
                    </div>
                  </div> <!-- card-body.// -->
                </div>
              </article> <!-- card-group-item.// -->
            </div>
          </div>



          <table class="table table-hover m-auto col-sm-9">
            <thead class="thead-dark">
              <tr>
                <th scope="col">#</th>
                <th scope="col">Ime</th>
                <th scope="col">Prezime</th>
                <th scope="col">Rejting</th>
                <th scope="col" class="sudija">Vise Info</th>
              </tr>
            </thead>
            <tbody>
                        
            @php
            $i = 1
            @endphp

            @foreach($players as $player)
            <tr>
                <td>{{ $i }}</td>                
                <td>{{ $player->name }}</td>
                <td>{{ $player->surname }}</td>
                <td>{{ $player->rating }}</td>
                <td><a class="btn btn-primary" href="igrac/{{ $player->id }}">+</a></td>
                @php
                $i++;
                @endphp
            </tr>
            @endforeach

            </tbody>
          </table>
        </div>
      </div>


@endsection
