@extends('layouts.app')


<link rel="stylesheet" href="{{ asset('plantilla/build/css/custom.css') }}">
@section('title', 'Bandejas | Cobranza')
@section('content')

<div id="contenedor_carga">
  <div id="cargar"></div>
</div>
 <!-- page content -->
 <div class="right_col" role="main">
        <!-- top tiles -->

       
        <!-- CLIENTES -->
        <div class="row tile_count">
         
          <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
            <span class="count_top"><i class="fa fa-user"></i> Total Clientes</span>
            <div class="count" id="cantidad"></div>
            <span class="count_bottom" >
              $ <i class="green" id="saldo"> </i> 
            </span>
          </div>

        <!-- PAGOS -->
            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
                <span class="count_top"><i class="fa fa-user"></i> Cantidad Pagos</span>
                  <br/>
                <span class="count" id="pagos"></span>
                  <i class="green">
                    <i class="fa fa-sort-asc" id="porcentajepagos"></i>% 
                  </i><em>En clientes</em><br/>
                  $<strong  id="valors2"></strong>&nbsp;
                  <span class="count_bottom"><i class="green"><span id="porcentajevalor2"></span>% </i> En Valor</span>
            </div>

            <!-- COMPROMISOS -->

            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
                <span class="count_top"><i class="fa fa-user"></i> Compromisos</span>
                  <br/>
                <span class="count" id="compromisostt"></span>
                  <i class="green">
                    <i class="fa fa-sort-asc" id="porcentajecompromiso"></i>% 
                  </i><em>En clientes</em><br/>
                  $<strong  id="valorcompromiso"></strong>&nbsp;
                  <span class="count_bottom"><i class="green"><span id="porcentajecompromisovalor"></span>% </i> En Valor</span>
            </div>

              <!-- incumplidos -->
              <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
                  <span class="count_top"><i class="fa fa-user"></i> Incumplidos</span>
                    <br/>
                  <span class="count" id="incumplidos"></span>
                    <i class="red">
                      <i class="fa fa-sort-asc" id="porcentajeincumplido"></i>% 
                    </i><em>En clientes</em><br/>
                    $<strong  id="valorincumplido"></strong>&nbsp;
                    <span class="count_bottom"><i class="red"><span id="porcentajeincumplidovalor"></span>% </i> En Valor</span>
              </div>

                 <!-- incumplidos -->
                 <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
                    <span class="count_top"><i class="fa fa-user"></i> Por Trabajar</span>
                      <br/>
                    <span class="count" id="incumplidos"></span>
                      <i class="red">
                        <i class="fa fa-sort-asc" id="porcentajeincumplido"></i>% 
                      </i><em>En clientes</em><br/>
                      $<strong  id="valorincumplido"></strong>&nbsp;
                      <span class="count_bottom"><i class="red"><span id="porcentajeincumplidovalor"></span>% </i> En Valor</span>
                </div>



        <!-- VALORES RECUPERADOS  -->
          <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
            <span class="count_top"><i class="fa fa-user"></i> Valores Recaudados</span>
            <div class="count green" id="valors">$ </div>
            <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc" id="porcentajevalor"></i>% </i> En el mes</span>
          </div>


     
        
        </div>
        <!-- /top tiles -->
        <div class="card">
            <div class="card-header no-border">
              <h3 class="card-title">GESTIONES </h3>
              <div class="card-tools">
                <a href="#" class="btn btn-tool btn-sm">
                  <i class="fas fa-download"></i>
                </a>
                <a href="#" class="btn btn-tool btn-sm">
                  <i class="fas fa-bars"></i>
                </a>
              </div>
            </div>
            <div class="card-body p-0">
              <table class="table table-striped table-valign-middle">
                <thead>
                <tr>
                  <th>Area</th>
                  <th>Asignado</th>
                  <th>Llamadas totales</th>
                  <th>Tocados</th>
                  <th>Efectivos</th>
                  <th>Productividad</th>
                  <th></th>
                </tr>
                </thead>
                <tbody>
                <tr>

                  <td id="descripcion">
                  </td>
                  <td id="asignado">
                  </td>
                  <td id="llamadastt">
                  </td>
                  <td id="tocados">
                  </td>
                  <td id="efectivos">
                  </td>
                  <td id="productividad"> <span>%</span> 
                  </td>
                  <td id="progressbar">
                      <div class="progress progress-xs">
                          <div class="progress-bar progress-bar-danger" style="width: 60%"></div>
                        </div>
                  </td>
                </tr>
                </tbody>
              </table>
            </div>
          </div>
        
      <!-- /page content -->
 
     
@endsection

@section('script')
<script>
  window.onload = function(){
    var contenedor = document.getElementById('contenedor_carga');
    contenedor.style.visibility = 'hidden';
    contenedor.style.opacity = 0;
  }
</script>
<script src="{{ asset('js/Bandeja/jquery.min.js') }}" ></script>

<script src="{{ asset('js/Bandeja/bandejaagente.js') }}" ></script>
@endsection