@extends('layouts.app')

<link rel="stylesheet" href="{{ asset('plantilla/build/css/custom.css') }}">
@section('title', 'Bandejas | Cobranza')
@section('content')

<meta name="csrf-token" content="{{ csrf_token() }}">
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
                    <span class="count_top"><i class="fa fa-user"></i> Por trabajar</span>
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

        
      <!-- /page content -->
 
     
@endsection

@section('script')

<script src="{{ asset('js/Bandeja/jquery.min.js') }}" ></script>

<script src="{{ asset('js/Bandeja/bandejaagente.js') }}" ></script>
@endsection