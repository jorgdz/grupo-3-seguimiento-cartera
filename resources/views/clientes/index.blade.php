@extends('layouts.app')

@section('title', 'Campañas')

@section('content')

<div class="row">
    <div class="col-lg-12">

	    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Campañas de clientes</h3>
             <br>
            @if(session('msg'))
                <div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h5><i class="icon fas fa-check"></i>Excelente</h5>                                     
                    <ul>                         
                        <li>{{ session("msg") }}</li>                                   
                    </ul>
                </div>
            @endif
            
            @if(session('error'))
                <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h5><i class="icon fas fa-check"></i>Error</h5>                                     
                    <ul>                         
                        <li>{{ session("error") }}</li>                                   
                    </ul>
                </div>
            @endif  

          	<!--Buscar-->             		
     		{!! Form::open(['route' => 'clientes.index', 'method' => 'GET', 'class' => 'navbar-form navbar-left', 'role' => 'search']) !!}
                    
                    <div class="form-group">
                        <div class="row">                       
                            
                            {!! Form::text('cedula', null, ['class' => 'form-control col-lg-6', 'placeholder' => 'Buscar por cédula del cliente']) !!}                                                       
                            <button type="submit" class="btn btn-info">Buscar</button>

                        </div>
                    </div>            
            {!! Form::close() !!}
        </div>
        <div class="card-body table-responsive">
            <table class="table table-bordered table-hover table-striped ">
                <thead>
                    <tr>
                        <th>Cédula</th>
                        <th>Nombres</th>
                        <th>Campaña</th>
                        <th>Deuda</th>
                        <th>Saldo</th>
                	    <th>Pagos</th>     
                    </tr>
                </thead>
              <tbody>
				@foreach($detalleCampanias as $camp)
                  	<tr>
                        <td>{{ $camp->cliente->cedula }}</td>
                        <td>{{ $camp->cliente->nombres }} {{ $camp->cliente->apellidos }}</td>
                        <td>{{ $camp->campania->nombre_campania }}</td>
                        <td>{{ $camp->valor_deuda }}</td>
                        <td>{{ ($camp->valor_saldo < 0.1) ? 0 : $camp->valor_saldo }}</td>
    	        
                        <td>    
                            <a href="{{route('clientes.show', $camp->id)}}" class="btn btn-sm btn-primary"><i class="fa fa-dollar-sign"></i></a>
                        </td>

                  	</tr>
				@endforeach
              </tbody>         
            </table>
        
          </div>     
        </div>
	      
    </div>
</div>       
@endsection