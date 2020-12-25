@extends('layouts.app')

@section('title', 'Rol '.$rol->name )
@section('content')

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h1 class="card-title">Rol {{ $rol->name }} </h1>
                    <br>                
                </div>
                <div class="card-body">
                    <h5><strong>Nombre:</strong> {{ $rol->name }}</h5>
                    <h5><strong>URL:</strong> {{ $rol->slug }}</h5>
                    <h5><strong>Descripción:</strong> {{ $rol->description }}</h5>
                    <h5><strong>Fecha de creación:</strong> {{ $rol->created_at }}</h5>
                    <h5><strong>Última actualización:</strong> {{ $rol->updated_at }}</h5>             
                    <h3>Permisos</h3>
                    <ul>
                        @if($rol->special == 'all-access')
                            
                            <li>Acceso total</li>

                        @else
                            
                            @if(sizeof($rol->permisoRoles) > 0)
                                @foreach($rol->permisoRoles as $rol)
                                    <li>{{ $rol->permiso->name }}</li>
                                @endforeach
                            @else
                                <li>No hay permisos asignados a este rol</li>
                            @endif

                        @endif
                    </ul>      
                </div>
            
                <div class="card-footer">
                  
                </div>
            </div>
        </div>
    </div>

@endsection
