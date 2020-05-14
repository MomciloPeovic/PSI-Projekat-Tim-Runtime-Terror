@extends('master')
@section('title','Portal sahovskog saveza')
@section('content-no-container')

<script>
    function prikazi_igrace(strana_ = 1) {
      let ime_filter = document.getElementById("ime_filter").value;
      let pol_filter = document.getElementById("pol_filter").value;
      let min_rejting_filter = document.getElementById("min_rejting_filter").value;
      let max_rejting_filter = document.getElementById("max_rejting_filter").value;
      let strana = strana_;

      $.ajax({
        type: "POST",
        url: "/igrac",
        data: {_token:'<?php echo csrf_token();?>',ime_filter:ime_filter,pol_filter,pol_filter,min_rejting_filter:min_rejting_filter,max_rejting_filter:max_rejting_filter,strana:strana},
        success: function (data) {
          document.getElementById("igraci_tabla").innerHTML = data;
          return;
        },
        error: function (data) {
          return;
        },
      });
    }
    window.onload = function(){prikazi_igrace();}
    $(document).on('keyup','#ime_filter',function(){prikazi_igrace();});
    $(document).on('keyup','#min_rejting_filter',function(){prikazi_igrace();});
    $(document).on('keyup','#max_rejting_filter',function(){prikazi_igrace();});
    $(document).on('change','#pol_filter',function(){prikazi_igrace();});

</script>

<ul class="nav nav-tabs nav-fill mt-3" id="myTab" role="tablist">
    <li class="nav-item">
      <a class="nav-link active" id="igraci-tab" data-toggle="tab" href="#igraci" role="tab" aria-controls="igraci"
        onclick="pregled('igraci')" aria-selected="true">Igraci</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" id="klubovi-tab" data-toggle="tab" href="#klubovi" role="tab" aria-controls="klubovi"
        onclick="pregled('klubovi')" aria-selected="false">Klubovi</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" id="takmicenja-tab" data-toggle="tab" href="#takmicenja" role="tab" aria-controls="takmicenja"
        aria-selected="false">Turniri</a>
    </li>
  </ul>
  <div class="tab-content" id="myTabContent">

    <!-- IGRACI TAB -->
    <div class="tab-pane fade show active p-5" id="igraci" role="tabpanel" aria-labelledby="igraci-tab">
      <div class="container">
        <div class="row">
          <div class="col-sm-3">

            <!-- FILERI  IGRACI -->
            <p>Filter</p>
            <div class="card">
              <article class="card-group-item">
                <header class="card-header">
                  <h6 class="title">Ime </h6>
                </header>
                <div class="filter-content">
                  <div class="card-body">
                    <input type="text" class="form-control" id="ime_filter">

                  </div> <!-- card-body.// -->
                </div>
              </article> <!-- card-group-item.// -->

              <article class="card-group-item">
                <header class="card-header">
                  <h6 class="title">Pol </h6>
                </header>
                <div class="filter-content">
                  <div class="card-body">
                      <select class="form-control" id = "pol_filter">
                        <option value="Svi" selected>Svi</option>
                        <option value="Muski">Muski</option>
                        <option value="Zenski">Zenski</option>
                      </select>
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
                        <input type="number" class="form-control" placeholder="0" id="min_rejting_filter">
                      </div>
                      <div class="form-group col-md-6 text-right">
                        <label>Max</label>
                        <input type="number" class="form-control" placeholder="3000" id="max_rejting_filter">
                      </div>
                    </div>
                  </div> <!-- card-body.// -->
                </div>
              </article> <!-- card-group-item.// -->
            </div>
          </div>
          <!-- /FILERI IGRACI -->

          <!-- TABELA IGRACI -->
          <table class="table col-sm-9">
            <thead class="thead-dark">
              <tr>
                <th scope="col">#</th>
                <th scope="col">Ime</th>
                <th scope="col">Prezime</th>
                <th scope="col">Rejting</th>
                <th scope="col">Vise</th>
              </tr>
            </thead>
            <tbody id = "igraci_tabla">
                
            </tbody>
          </table>
         <!-- /TABELA IGRACI -->


        </div>
      </div>
    </div>
    <!-- KLUBOVI TAB -->
    <div class="tab-pane fade p-5" id="klubovi" role="tabpanel" aria-labelledby="klubovi-tab">
      <div class="container">
        <div class="row">
          <div class="col-sm-3">
            
            <!-- FILERI  KLUB -->
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
            <!-- /FILERI  KLUB -->
        
          <!-- TABLA  KLUB -->
          <table class="table table-hover col-sm-9">
            <thead class="thead-dark">
              <tr>
                <th scope="col">#</th>
                <th scope="col">Naziv</th>
                <th scope="col">Broj clanova</th>
                <th scope="col">Rejting</th>
              </tr>
            </thead>
            <tbody>
              
            </tbody>
            <!-- /TABLA  KLUB -->
          </table>
        </div>
      </div> 
    </div>
    <!-- TURNIRI TAB -->
    <div class="tab-pane fade p-5" id="takmicenja" role="tabpanel" aria-labelledby="takmicenja-tab">
      <div class="container">
        <div class="row">
          <div class="col-sm-3">
            
            <!-- FILERI TURNIRI -->
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
                  <h6 class="title">Mesto odrzavanja </h6>
                </header>
                <div class="filter-content">
                  <div class="card-body">
                    <input type="text" class="form-control">

                  </div> <!-- card-body.// -->
                </div>
              </article> <!-- card-group-item.// -->

              <article class="card-group-item">
                <header class="card-header">
                  <h6 class="title">Broj kola</h6>
                </header>
                <div class="filter-content">
                  <div class="card-body">
                    <input type="number" class="form-control">

                  </div> <!-- card-body.// -->
                </div>
              </article> <!-- card-group-item.// -->

              <article class="card-group-item">
                <header class="card-header">
                  <h6 class="title">Vreme odrzavanja</h6>
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
        <!-- /FILERI TURNIRI -->

        <!-- TABLA TURNIRI -->
          <table class="table table-hover col-sm-9">
            <thead class="thead-dark">
              <tr>
                <th scope="col">#</th>
                <th scope="col">Naziv</th>
                <th scope="col">Datum pocetka</th>
                <th scope="col" class="igrac">Vise</th>

                @auth('player') 
                  <th scope="col" class="igrac">Prijava</th>
                @endauth 

                @auth('club')
                  <th scope="col" class="igrac">Prijava</th>
                @endauth
                
              </tr>
            </thead>
            <tbody>
            </tbody>
            <!-- /TABLA TURNIRI -->
          </table>
        </div>
      </div>
    </div>
  </div>


@endsection
