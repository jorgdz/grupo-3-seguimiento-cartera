@extends('layouts.app')

@section('title', 'Administración')
@section('content')

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h1 class="card-title">Bienvenido</h1>
                </div>
                <div class="card-body">
                    @if($user->perfil_actualizado)
                        <h5><strong>Nombre:</strong> {{ $user->apellido_paterno }} {{ $user->apellido_materno }} {{ $user->nombre1 }}</h5>
                        <h5><strong>Nombre de usuario:</strong> {{ $user->usuario }}</h5>
                        <h5><strong>Rol(es):</strong></h5>
                        <ul>
                            @if(sizeof($user->usuarioRoles) > 0)
                                @foreach($user->usuarioRoles as $roles)
                                    <li><strong>{{ $roles->rol->name }}</strong></li>

                                    <p>Permiso a:</p>
                                    <ul>
                                        @if($roles->rol->special == 'all-access')
                                            <li>Acceso total</li>
                                        @else
                                            @if(sizeof($roles->rol->permisoRoles)  > 0)
                                                @foreach($roles->rol->permisoRoles as $permission)
                                                    <li>{{ $permission->permiso->name }}: <em>{{ $permission->permiso->description }}</em></li>    
                                                @endforeach
                                            @else
                                                <li>No tiene permisos asignados a este rol</li>
                                            @endif
                                            
                                        @endif
                                    </ul>
                                @endforeach
                            @else
                                <li>No tiene roles asignados</li>
                            @endif
                            
                            <br>
                            <div class="table-responsive">
                                <h5><strong>Cargos departamentales:</strong></h5>
                                @if(sizeof($user->cargosDepartamento)  > 0)
                                    <table class="table table-bordered table-hover table-striped">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Cargo</th>
                                                <th>Departamento</th>               
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($user->cargosDepartamento as $key => $cargoDep)
                                              <tr>
                                                <td>{{ ($key + 1) }}</td>
                                                <td>{{ $cargoDep->cargo->nombre_cargo }}</td>
                                                <td>{{ $cargoDep->departamento->nombre_departamento }}</td>                                                                   
                                              </tr>
                                            @endforeach
                                        </tbody>
                                    </table>     
                                @else
                                    <br>
                                    <h5>No tiene cargos asignados</h5>
                                @endif
                            </div>
                        </ul>
                        @if($user->campania)
                            <hr>
                            <h5><strong>Campaña:</strong> {{ $user->campania }}</h5>
                        @endif
                    @else
                        <h3><em>Por favor usuario, actualice sus datos antes de empezar a trabajar, <a href="{{route('perfil.edit')}}">Ir a mi perfil.</a></em></h3>
                    @endif
                </div>
            </div>
        </div>
    </div>
    
@endsection
