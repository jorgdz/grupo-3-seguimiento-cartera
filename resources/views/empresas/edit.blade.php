@extends('layouts.app')

@section('title', 'Empresa '.$empresa->nombre_empresa)
@section('content')
	
	<div class="row">
        <div class="col-lg-8">
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
                                @foreach ($errors->all() as $error)
                                    <li> {{ $error }} </li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <h1 class="card-title"><strong>Empresa:</strong> {{$empresa->nombre_empresa}}</h1>
                    <br>                
                </div>
                <div class="card-body">
                    {!! Form::model($empresa, ['route' => ['empresas.update', $empresa->id], 'method' => 'PUT']) !!}
                   
                    <div class="form-group">
                    {{ Form::label('nombre_empresa', 'Nombre') }}
                    {{ Form::text('nombre_empresa', null, ['class' => 'form-control']) }}
                    </div>

                    <div class="form-group">
                        {{ Form::label('descripcion_empresa', 'Descripción') }}
                        {{ Form::textarea('descripcion_empresa', null, ['class' => 'form-control']) }}
                    </div>               
                    
                    <div class="card-body"> 
                        <h3>Departamentos:</h3>
                        
                        <div class="form-group">
                            <ul class="list-unstyled">
                                @foreach($departamentos as $departamento)
                                    <li>
                                        <label>
                                            <!--La instrucción in_array me devuelve true o false para que se marque el checkbox-->
                                            {{ Form::checkbox('departamentos[]', $departamento->id, in_array($departamento->id, $departamentos_id)) }}
                                            {{ $departamento->nombre_departamento }}
                                        </label>
                                    </li>
                                @endforeach
                            </ul>
                        </div>    

                        @can('departamentos.create')
                            <a href="{{ route('departamentos.create') }}" class="btn btn-sm btn-info pull-right">Crear un nuevo departamento</a>
                        @endcan

                    </div>      
                    <div class="card-footer">
                        {{ Form::submit('Guardar todo', ['class' => 'btn btn-sm btn-primary']) }}
                    </div>
                </div>

                {!! Form::close() !!}
            </div>
        </div>
    </div>

@endsection