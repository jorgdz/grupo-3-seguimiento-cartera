@extends('layouts.app')

@section('title', 'Administración - Planes de pago')
@section('content')

   <div class="content-header">
      <div class="container-fluid">
         <div class="row mb-2">
            <div class="col-sm-12">
               <ol class="breadcrumb float-sm-left">
                  @if(Auth::user()->perfil_actualizado)
                        @can('pagos.report-general')
                           <li class="breadcrumb-item"><a class="btn btn-success" href="/pagos/report-general/Aldia" target="_blank">Clientes Al día</a></li>
                           <li class="breadcrumb-item"><a class="btn btn-info" href="/pagos/report-general/Pendiente" target="_blank">Clientes Pendientes</a></li>
                           <li class="breadcrumb-item"><a class="btn btn-danger" href="/pagos/report-general/Incumplido" target="_blank">Clientes incumplidos</a></li>
                        @endcan
                  @endif
               </ol>
            </div>
         </div>
      </div>
   </div>
   
   <hr>
   <dashboard-component></dashboard-component>
    
@endsection
