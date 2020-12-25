@extends('layouts.app')

@section('title', $rol->name)
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

                    <h1 class="card-title"><strong>Rol:</strong> {{$rol->name}}</h1>
                    <br>                
                </div>
                <div class="card-body">
                    {!! Form::model($rol, ['route' => ['roles.update', $rol->id], 'method' => 'PUT']) !!}
                    <div class="form-group">
                    {{ Form::label('name', 'Nombre') }}
                    {{ Form::text('name', null, ['class' => 'form-control']) }}
                    </div>

                    <div class="form-group">
                        {{ Form::label('slug', 'Ruta amigable') }}
                        {{ Form::text('slug', null, ['class' => 'form-control']) }}
                    </div>

                    <div class="form-group">
                        {{ Form::label('description', 'Descripción') }}
                        {{ Form::textarea('description', null, ['class' => 'form-control']) }}
                    </div>

                    <h3>Acceso total</h3>
                    <div class="form-group">
                        <label>{{ Form::radio('special', 'all-access') }} Acceso total</label>
                        <label>{{ Form::radio('special', '') }} Sin acceso</label>
                    </div>

                    <h3>Permisos</h3>

                    <div class="form-group">
                        <ul class="list-unstyled">
                            @foreach($permisos as $permiso)
                                <li>
                                    <label>
                                        {{ Form::checkbox('permissions[]', $permiso->id, null) }}
                                        {{ $permiso->name }}:

                                        <em>{{ $permiso->description ?: 'No hay descripción'}}</em>
                                    </label>
                                </li>
                            @endforeach
                        </ul>
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