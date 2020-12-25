@extends('layouts.app')

@section('title', $user->nombre1)
@section('content')

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h1 class="card-title"><strong>Usuario</strong> {{ $user->apellido_paterno }} {{ $user->apellido_materno }} {{ $user->nombre1 }} {{ $user->nombre2 }}</h1>
                	<br>               	
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col col-lg-4">
                            <h5><strong>Usuario:</strong> {{ $user->usuario }}</h5>
                            <h5><strong>Cédula:</strong> {{ $user->cedula }}</h5>
                            <h5><strong>Nombres:</strong> {{ $user->nombre1 }} {{ $user->nombre2 }}</h5>
                            <h5><strong>Apellidos:</strong> {{ $user->apellido_paterno }} {{ $user->apellido_materno }}</h5>
                            <h5><strong>Género:</strong> {{ $user->genero->nombre_genero }}</h5>
                            <h5><strong>Fecha de creación:</strong> {{ $user->created_at }}</h5>
                            <h5><strong>Última actualización:</strong> {{ $user->updated_at }}</h5>    
                            <h5><strong>Roles</strong></h5>
                            <ul>
                                @if(sizeof($user->usuarioRoles) > 0)
                                    @foreach($user->usuarioRoles as $rol)
                                        <li>{{ $rol->rol->name }}</li>
                                    @endforeach
                                @else
                                    <li>El usuario {{ $user->nombre1 }} {{ $user->apellido_paterno }} no tiene roles asignados</li>
                                @endif
                            </ul> 
                        </div>

                        <div class="col col-lg-8">   
                            <h5><strong>Cargos asignados</strong></h5>
                            @if(session('msg'))
                                <div class="alert alert-success alert-dismissible">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                    <h5><i class="icon fas fa-check"></i>Excelente</h5>                                     
                                    <ul>                         
                                        <li>{{ session("msg") }}</li>                                   
                                    </ul>
                                </div>
                            @endif
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover table-striped">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Cargo</th>
                                            <th>Departamento</th>
                                            <th>Empresa</th>
                                            @if(Auth::user()->can('cargosdepartamento.destroy'))
                                                <th>Acciones</th>
                                            @endif
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if(sizeof($user->cargosDepartamento) > 0)
                                            @foreach ($user->cargosDepartamento as $key => $cargoDep)
                                              <tr>
                                                <td>{{ ($key + 1) }}</td>
                                                <td>{{ $cargoDep->cargo->nombre_cargo }}</td>
                                                <td>{{ $cargoDep->departamentoEmpresa->departamento->nombre_departamento }}</td>
                                                <td>{{ $cargoDep->departamentoEmpresa->empresa->nombre_empresa }}</td>    
                                                @can('cargosdepartamento.destroy')
                                                    <td>    
                                                        {!! Form::open(['route' => ['cargosdepartamento.destroy', $cargoDep->id], 'method' => 'DELETE']) !!}
                                                            <button class="btn btn-sm btn-danger" onclick="return confirm('¿ ESTAS SEGURO QUE DESEAS ELIMINAR ?')"><i class="fa fa-trash"></i></button>
                                                        {!! Form::close() !!}
                                                    </td>        
                                                @endcan                                            
                                              </tr>
                                            @endforeach
                                        @else
                                            <tr>
                                                <td colspan="5">Sin cargos asignados</td>
                                            </tr>
                                        @endif
                                    </tbody>
                                </table>     
                            </div>
                        </div>
                    </div>

                </div>         
                
                <div class="card-footer">
                  
                </div>
            </div>
        </div>
    </div>

@endsection
