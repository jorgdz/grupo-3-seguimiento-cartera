@extends('layouts.app')

@section('title', ' CLIENTES | Ventas')
@section('content')
    <!-- tabla DAMPLUSagenda--->

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                 
                    @if(session('msg'))
                        <div class="alert alert-success alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <h5><i class="icon fas fa-check"></i>Excelente</h5>                                     
                            <ul>                         
                                <li>{{ session("msg") }}</li>                            
                            </ul>
                        </div>
                    @endif
                    
                    @if (count($errors) > 0)
                        <div class="alert alert-danger alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <h5><i class="icon fas fa-exclamation-triangle"></i>Error</h5>  
                            <ul>
                            </ul>
                        </div>
                    @endif
                    @if ($errors->any())
                        <div class="alert alert-warning">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>
                
                <section class="col-lg-12 connectedSortable">
                <div class="alert alert-primary" role="alert">
                    <center> <strong>Cliente Detalle</strong> </center>    
                </div>

                <table class="table table-hover table-condensed">
                    <thead>
                        <th>Cedula</th>
                        <th>Nombres</th>
                        <th>Direccion</th>
                        <th>Dato</th>
                        <th>Dato2</th>
                        <th>Dato3</th>
                    </thead>
                    <tbody>
                        <td>{{ $datos->IdCampañaPersona }}</td>    
                        <td>{{ $datos->Campo2 }}</td>  
                        <td>{{ $datos->Campo5 }}</td>  
                        <td>{{ $datos->Campo3 }}</td> 
                        <td>{{ $datos->Campo4 }}</td>  
                        <td>{{ $datos->Campo8 }}</td>   
                    </tbody>
                </table>
            </section>
            </div> 
        </div> 
    </div>   
       


    <div class="row">

        <div class="col-md-6 col-sm-6 col-xs-6">

            @if(Session::has('info'))
            <div class="alert alert-warning alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <center> <strong>{{ Session::get('info') }}</strong></center>  
            </div>
            @endif
          <div class="card card-info">
            {!! Form::open(['route' => 'agendar.store']) !!}
            @include('Ventas.Clientes.form.agenda')
            {!! Form::close() !!}
  
        </div>
   
        <div class="col-md-6">
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Agendas Pendientes </h3>
            </div>
                <div class="card-body">
                        @foreach ($agenda as $agendas)
                      
                    <ul class="todo-list">
                           
                        <li>
                            <span class="handle">
                            <i class="fas fa-ellipsis-v"></i>
                            <i class="fas fa-ellipsis-v"></i>
                            </span>
                            <b>Fecha y Hora de Llamada: </b>
                            <span class="text">{{ Carbon\Carbon::parse($agendas->fecha)->format('d-m-Y') }}</span>
                            <span class="text">{{ Carbon\Carbon::parse($agendas->hora)->format('h:m:s') }}</span>
                            <span class="text">{{ $agendas->turno }}</span>
                        @php
                        $color = "";
                        @endphp
                            @if ($agendas->dias < 0)
                                @php
                                $color = "badge badge-danger";
                                @endphp
                            @else
                                @if ($agendas->dias == 0)
                                    @php
                                    $color = "badge badge-warning";
                                    @endphp
                                @else
                                
                                    @php
                                    $color = "badge badge-success";
                                    @endphp
                            
                                @endif
                            @endif
                            @if ($agendas->dias < 0)
                            <small class="{{ $color }}"><i class="far fa-clock"></i>  Vencido</small>
                            @else  
                                @if ($agendas->dias == 0)
                            <small class="{{ $color }}"><i class="far fa-clock"></i>  HOY</small>
                                @else
                            <small class="{{ $color }}"><i class="far fa-clock"></i> {{ $agendas->dias }} Dias</small>
                                @endif
                            @endif
                        <br>
                        <b>Comentario: </b>
                            <span class="text">{{ $agendas->comentario }}</span>
                            <div class="tools">
                            <i class="fas fa-edit"></i>
                            <i class="fas fa-trash-o"></i>
                            </div>
                        </li>
                        <hr>
                    </ul>
                    
                    @endforeach
                   
                </div>
              
            </div>

          </div>
        </div>

      </div>



     

 

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
            <div class="alert alert-warning   " role="alert">
                <center> <strong>Gestiones Detalle</strong> </center>    
            </div>
                <section class="col-lg-12 connectedSortable">
                <table class="table table-striped">
                    <thead class="thead-dark">
                        
                        <th>Fecha</th>
                        <th>Agente</th>
                        <th>Telefono</th>
                        <th>Estado</th>
                        <th WIDTH="25%">Comentario</th>
                    
                    </thead>
                    <tbody class="table-striped ">
                        @foreach ($gestiones as $gestion)
                        <tr>
                        <td>{{  Carbon\Carbon::parse($gestion->FecRegistro)->format('d-m-Y ')  }}</td>
                        <td>{{ $gestion->UsuRegistro }}</td>
                        <td>{{ $gestion->Contacto }}</td>    
                        <td>{{ $gestion->estado }}</td>  
                        <td>{{ $gestion->Observacion }}</td> 
                      
                    </tr>
                    @endforeach
                    </tbody>
                </table> 
                </section>  
            </div>
        </div>
    </div>
       
           

 
    @endsection

    @section('script')

    
  
    
    @endsection