@extends('layouts.app')


<link rel="stylesheet" href="{{ asset('plantilla/build/css/custom.css') }}">

<link rel="stylesheet" href="{{ asset('datatables/dataTables.bootstrap4.css') }}">

@section('title', 'Bandejas | Cobranza')
@section('content')

<div id="contenedor_carga">
  <div id="cargar"></div>
</div>

<div class="row">
  <!--
  <div class="col-md-3 col-sm-6 col-12">
    <div class="info-box">
      <span class="info-box-icon bg-info"><i class="far fa-envelope"></i></span>

      <div class="info-box-content">
        <span class="info-box-text">Messages</span>
        <span class="info-box-number">1,410</span>
      </div>
 
    </div>
  </div><i class="far fa-hand-point-right"></i>
  -->
  <div class="col-md-3 col-sm-6 col-12">
    <div class="info-box">
      <span class="info-box-icon bg-success"><i class="far fa-flag"></i></span>

      <div class="info-box-content">
        <span class="info-box-text">Metas</span>
        <span class="info-box-number">850</span>
      </div>
      <!-- /.info-box-content -->
    </div>
    <!-- /.info-box -->
  </div>
  <!-- /.col -->
  <div class="col-md-3 col-sm-6 col-12">
    <div class="info-box">
      <span class="info-box-icon bg-info">  <img src="{{ asset('pacificard.png') }}" class="img-circle " ></span>

      <div class="info-box-content">
        <span class="info-box-text">PACIFICARD </span>
        <span class="info-box-number">3.00</span>
      </div>
      <!-- /.info-box-content -->
    </div>
    <!-- /.info-box -->
  </div>
  <!-- /.col -->
  <div class="col-md-3 col-sm-6 col-12">
    <div class="info-box">
      <span class="info-box-icon bg-danger"><img src="{{ asset('dp.jpg') }}" class="img-circle " ></span>

      <div class="info-box-content">
        <span class="info-box-text">DEPRATI</span>
        <span class="info-box-number">2.80</span>
      </div>
      <!-- /.info-box-content -->
    </div>
    <!-- /.info-box -->
  </div>
  <!-- /.col -->

  <div class="col-md-3 col-sm-6 col-12">
      <div class="info-box">
        <span class="info-box-icon bg-danger"><img src="{{ asset('claro.jpg') }}" class=" " ></span>
  
        <div class="info-box-content">
          <span class="info-box-text">Planes</span>
          <span class="info-box-number">--</span>
        </div>
        <!-- /.info-box-content -->
      </div>
      <!-- /.info-box -->
    </div>
</div>
 <!-- page content -->
 <div class="right_col" role="main">
        <!-- top tiles -->

       
        <!-- CLIENTES -->
        <div class="row tile_count">
         
          <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
            <span class="count_top"><i class="fa fa-user"></i>  Clientes Tocados</span>
            <div class="count" id="cantidad"></div>
            <span class="count_bottom" >
           
            </span>
          </div>

        <!-- PAGOS -->
            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
                <span class="count_top"><i class="fa fa-user"></i> Cantidad Ventas</span>
                  <br/>
                <span class="count" id="ventas"></span>
                  <i class="green">
                    <i class="fa fa-sort-asc" id="putostt"></i>&nbsp;
                  </i><em>En puntos</em><br/>
                  <strong  id="putostt"></strong>&nbsp;
                  <span class="count_bottom"><i class="green"><span id="porcentajett"></span>% </i> En puntos</span>
            </div>

            <!-- COMPROMISOS -->

            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
                <span class="count_top"><i class="fa fa-user"></i> Incompletas</span>
                  <br/>
                <span class="count" id="incompletas"></span>
                  <i class="green">
                    <i class="fa fa-sort-asc" id=""></i> 
                  </i><em></em><br/>
                  <strong  id="valorcompromiso"></strong>&nbsp;
                  <span class="count_bottom"><i class="green"><span id="porcentajecompromisovalor"></span> </i> </span>
            </div>

              <!-- incumplidos -->
              <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
                  <span class="count_top"><i class="fa fa-user"></i> Interesados</span>
                    <br/>
                  <span class="count" id="interesados"></span>
                    <i class="red">
                      <i class="fa fa-sort-asc" id="porcentajeincumplido"></i>
                    </i><em></em><br/>
                    <strong  id="valorincumplido"></strong>&nbsp;
                    <span class="count_bottom"><i class="red"><span id="porcentajeincumplidovalor"></span> </i></span>
              </div>

                 <!-- incumplidos -->
                 <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
                    <span class="count_top"><i class="fa fa-user"></i> No Desean</span>
                      <br/>
                    <span class="count" id="dnc"></span>
                      <i class="red">
                        <i class="fa fa-sort-asc" id="porcentajeincumplido"></i>
                      </i><em></em><br/>
                      <strong  id="valorincumplido"></strong>&nbsp;
                      <span class="count_bottom"><i class="red"><span id="porcentajeincumplidovalor"></span> </i> </span>
                </div>



        <!-- VALORES RECUPERADOS  -->
          <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
            <span class="count_top"><i class="fa fa-user"></i> Puntos Acumulados</span>
            <div class="count green" id="putott"> </div>
            <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc" id="porcentajestt"></i>% </i> En el mes<span class="oi oi-target"></span></span>
          </div>

        </div>


        <div class="container">
          <div class="col-md-12">
             
              <div class="card card-primary">
                <div class="input-group">
                  <input type="text" class="form-control" id="texto" placeholder="Ingrese la Cedula">
                  <div class="input-group-append"><span class="input-group-text">Buscar</span></div>
                </div>
                <div id="resultados" class="bg-light border">
                </div>
              </div>
               
          </div>
          <div class="col-md-12">
              <div class="alert alert-success" role="alert">
                  Solo clientes que NO cuenten con un estado de Cerrado en el Sistema de Ventas como: <small>(Venta,Venta Incopleta, Venta Interesado, No Desean, No Aplican, Fuera de Zona)</small> 
                </div>
              <div class="card card-primary">
                <div class="card-header">
                  <h3 class="card-title">Agendas Pendientes </h3>
                </div>
                <div class="card-body">


                    <div class="card">
                        <div class="card-body p-0">
                          <table class="table table-striped" >
                            <thead>
                            <tr>
                              <th style="width: 10px">Cedula</th>
                              <th style="width: 10px" >Nombre</th>
                              <th style="width: 10px">Campaña</th>
                              <th style="width: 10px">Telefono</th>
                              <th style="width: 10px">Fecha</th>
                              <th style="width: 40px">Hora</th>
                            </tr>
                          </thead>
                          <tbody id="tablaDatos" >
                            
                          </tbody>
                          </table>
                        </div>
                   
                      </div>
               
              </div>
            </div> 
          </div>       
        </div>

        
     
@endsection

@section('script')


<script src="{{ asset('js/Bandeja/jquery.min.js') }}" ></script>

<script src="{{ asset('js/Bandeja/Ventas/bandejaagente.js') }}" ></script>
<script src="{{ asset('bootstrap/js/bootstrap.bundle.min.js') }}" ></script>
<script src="{{ asset('datatables/jquery.dataTables.js') }}" ></script>


<script src="{{ asset('datatables/dataTables.bootstrap4.js') }}" ></script>
<script>
    $(function () {
      $("#example1").DataTable();
      $('#example2').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": true,
        "info": true,
        "autoWidth": false,
      });
    });
  </script>

  <script>
    window.addEventListener('load',function(){
        document.getElementById("texto").addEventListener("keyup", () => {
            if((document.getElementById("texto").value.length)>=0)
                fetch(`buscador?texto=${document.getElementById("texto").value}`,{ method:'get' })
                .then(response  =>  response.text() )
                .then(html      =>  {   document.getElementById("resultados").innerHTML = html  })
            else
                document.getElementById("resultados").innerHTML = "No encotrado";
        })
    });  
  </script>

<script>
    window.onload = function(){
      var contenedor = document.getElementById('contenedor_carga');
      contenedor.style.visibility = 'hidden';
      contenedor.style.opacity = 0;
    }
  </script>
@endsection