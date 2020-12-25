@extends('layouts.app')

@section('title', 'Roles')
@section('content')

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h1 class="card-title">Roles existentes</h1>
                    <br>
                    <div>               
                        @can('roles.create')
                            <a href="{{ route('roles.create') }}" class="btn btn-sm btn-primary pull-right">Agregar rol</a>
                        @endcan
                    </div>
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
                </div>
                <div class="card-body table-responsive">
                    <table class="table table-bordered table-hover table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nombre</th>
                                <th>Descripción</th>
                                <th>Creación</th>
                                <th>Actualización</th>
                                <th>Acceso total</th>

                                @if(Auth::user()->can('roles.show') || Auth::user()->can('roles.edit') || Auth::user()->can('roles.destroy'))
                                     <th colspan="3">Acciones</th>
                                @endif
                                
                            </tr>
                        </thead>
                      <tbody>
                          @foreach ($roles as $key => $rol)
                            <tr>
                                <td>{{ ($key + 1) }}</td>
                                <td>{{ $rol->name }}</td>
                                <td>{{ $rol->description }}</td>
                                <td>{{ $rol->created_at }}</td>
                                <td>{{ $rol->updated_at }}</td>
                                <td>
                                    <span class="badge {{ ($rol->special == 'all-access') ? 'badge-success' : 'badge-warning' }}">{{ ($rol->special == 'all-access') ? 'SI' : 'NO' }}</span>
                                </td>
                                @can('roles.show')
                                    <td>    
                                        <a href="{{ route('roles.show', $rol->id) }}" class="btn btn-sm btn-info">
                                            <i class="fa fa-eye"></i>
                                        </a>
                                    </td>
                                @endcan
                                
                                @can('roles.edit')
                                    <td>
                                        <a href="{{ route('roles.edit', $rol->id) }}" class="btn btn-sm btn-warning">
                                             <i class="fa fa-pen"></i>
                                        </a>
                                    </td>
                                @endcan
                                @can('roles.destroy')
                                    <td>    
                                        {!! Form::open(['route' => ['roles.destroy', $rol->id], 'method' => 'DELETE']) !!}
                                            <button class="btn btn-sm btn-danger" onclick="return confirm('¿ ESTAS SEGURO QUE DESEAS ELIMINAR ?')"><i class="fa fa-trash" ></i></button>
                                        {!! Form::close() !!}
                                    </td>                               
                                @endcan
                            </tr>
                          @endforeach
                      </tbody>
                    </table>    
                </div>

                <div class="card-footer">
                    {{ $roles->render() }}
                </div>

            </div>
        </div>
    </div>

@endsection
