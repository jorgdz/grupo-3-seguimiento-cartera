@extends('layouts.app')

@section('title', 'Puestos')

@section('content')

<div class="row">
    <div class="col-lg-12">

	    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Puestos Predictivo</h3>
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
     		{!! Form::open(['route' => 'puestos.index', 'method' => 'GET', 'class' => 'navbar-form navbar-left', 'role' => 'search']) !!}
                    
                    <div class="form-group">
                        <div class="row">                       
                            
                            {!! Form::text('user', null, ['class' => 'form-control col-lg-6', 'placeholder' => 'Buscar Agente']) !!}                                                       
                            <button type="submit" class="btn btn-info">Buscar</button>

                        </div>
                    </div>            
            {!! Form::close() !!}
        </div>
        <div class="card-body table-responsive">
            <table class="table table-bordered table-hover table-striped ">
                <thead>
                    <tr>
                        <th>Agente</th>
                        <th>Nombres</th>
                        <th>Grupos</th>
                        <th>Extension</th>
                    </tr>
                </thead>
              <tbody>
				@foreach($datos as $dato)
                  	<tr>
                        <td>{{ $dato->user }}</td>
                        <td>{{ $dato->full_name }}</td>
                        <td>{{ $dato->user_group }}</td>
                        <td>{{ $dato->phone_login }}</td>
    	        
                        <td>    
                            <a href="{{route('puestos.edit', $dato->user)}}" class="btn btn-sm btn-primary"><i class="fas fa-angle-double-right"></i></a>
                        </td>

                  	</tr>
				@endforeach
              </tbody>         
            </table>
            {!! $datos->render() !!}
          </div>     
        </div>
	      
    </div>
</div>       
@endsection