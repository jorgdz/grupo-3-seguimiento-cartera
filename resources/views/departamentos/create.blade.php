@extends('layouts.app')

@section('title', 'Crear departamento')
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

                    <h1 class="card-title">Crear un nuevo <a href="{{ route('departamentos.index') }}">departamento</a></h1>
                    <br>                
                </div>
                <div class="card-body">
                    {!! Form::open(['route' => 'departamentos.store']) !!}
                    <div class="form-group">
                        {{ Form::label('nombre_departamento', 'Nombre') }}
                        {{ Form::text('nombre_departamento', null, ['class' => 'form-control', 'placeholder' => 'Nombre del departamento']) }}
                    </div>

                    <div class="form-group">
                        {{ Form::label('descripcion_departamento', 'Descripción') }}
                        {{ Form::textarea('descripcion_departamento', null, ['class' => 'form-control', 'placeholder' => 'Descripción del departamento']) }}
                    </div>              
                    <div class="card-footer">
                        {{ Form::submit('Enviar', ['class' => 'btn btn-sm btn-primary']) }}
                    </div>
                </div>

                {!! Form::close() !!}
            </div>
        </div>
    </div>

@endsection