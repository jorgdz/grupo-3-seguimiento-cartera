@extends('layouts.app')

@section('title', 'Usuarios')
@section('content')

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h1 class="card-title">Usuarios existentes</h1>
                	<br>
                	<div>        		
    	            	@can('users.create')
							<a href="{{ route('users.create') }}" class="btn btn-sm btn-primary pull-right">Agregar usuario</a>
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
      
                  {!! Form::open(['route' => 'users.index', 'method' => 'GET', 'class' => 'navbar-form navbar-left', 'role' => 'search']) !!}
                    
                    <div class="form-group">
                        <div class="row">                       
                            
                            {!! Form::text('search', null, ['class' => 'form-control col-lg-8', 'placeholder' => 'Buscar por cédula, nombres, apellidos, o usuario']) !!}                                                       
                            <button type="submit" class="btn btn-info">Buscar</button>

                        </div>
                    </div>

                  {!! Form::close() !!}
             
                 
                </div>
                <div class="card-body table-responsive">
                    <table class="table table-bordered table-hover table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Cédula</th>
                                <th>Nombres</th>
                                <th>Apellidos</th>
                                <th>Usuario</th>
                                <th>Género</th>
                                <th>FecNac</th>
                                <th>Estado</th>
                                <th>Area</th>
                                         

                                @if(Auth::user()->can('users.show') || Auth::user()->can('users.position') || Auth::user()->can('users.edit') || Auth::user()->can('users.destroy'))
                                    <th colspan="4">Acciones</th>
                                @endif

                            </tr>
                        </thead>
                      <tbody>
                          @foreach ($users as $key => $user)
                              <tr>
                                <td>{{ ($key + 1) }}</td>
                                <td>{{ $user->cedula }}</td>
                                <td>{{ $user->nombre1 }} {{ $user->nombre2 }}</td>
                                <td>{{ $user->apellido_paterno }} {{ $user->apellido_materno }}</td>
                                <td>{{ $user->usuario }}</td>
                                <td>{{ $user->genero->abreviatura }}</td>
                                <td>{{ $user->fecha_nacimiento }}</td>                          
                                <td> <span class="badge {{ ($user->enabled) ? 'badge-success' : 'badge-danger' }}">{{ ($user->enabled) ? 'Activo' : 'Inactivo' }}</span></td> 
                                <td>{{ $user->area }}</td>
                           
                                @can('users.show')
                                    <td>    
                                        <a href="{{ route('users.show', $user->id) }}" class="btn btn-sm btn-info">
                                            <i class="fa fa-eye"></i>
                                        </a>
                                    </td>
                                @endcan
                                @can('users.position')
                                    <td>    
                                        <a href="{{ route('users.position', $user->id) }}" class="btn btn-sm btn-success">
                                            <i class="fas fa-briefcase"></i>
                                        </a>
                                    </td>
                                @endcan
                                @can('users.edit')
                                    <td>
                                        <a href="{{ route('users.edit', $user->id) }}" class="btn btn-sm btn-warning">
                                             <i class="fa fa-pen"></i>
                                        </a>
                                    </td>
                                @endcan
                                @can('users.destroy')
                                    <td>    
                                        {!! Form::open(['route' => ['users.destroy', $user->id], 'method' => 'DELETE']) !!}
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
                    {{ $users->render() }}
                </div>

            </div>
        </div>
    </div>

@endsection
