@extends('layouts.app')

@section('title', 'Permisos')

@section('content')

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Permisos</h3>
                 <br>
                  <div>               
                      @can('permissions.create')
                          <a href="{{ route('permissions.create') }}" class="btn btn-sm btn-primary pull-right">Agregar permiso</a>
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
                  
                  <!--Buscar-->
      
                  {!! Form::open(['route' => 'permissions.index', 'method' => 'GET', 'class' => 'navbar-form navbar-left', 'role' => 'search']) !!}
                    
                    <div class="form-group">
                        <div class="row">                       
                            
                            {!! Form::text('search', null, ['class' => 'form-control col-lg-6', 'placeholder' => 'Buscar por nombre, descripción o URL del permiso']) !!}                                                       
                            <button type="submit" class="btn btn-info">Buscar</button>

                        </div>
                    </div>

                  {!! Form::close() !!}
                
            </div>
            <div class="card-body table-responsive">
                    <table class="table table-bordered table-hover  table-striped ">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nombres</th>
                                <th>URL</th>
                                <th>Descripción</th>
                            
                                @if(Auth::user()->can('permissions.edit') || Auth::user()->can('permissions.destroy'))
                                     <th colspan="2">Acciones</th>
                                @endif

                            </tr>
                        </thead>
                      <tbody>
                          @foreach ($permisos as $key => $permiso)
                              <tr>
                                  <td>{{ ($key + 1) }}</td>
                                  <td>{{ $permiso->name }}</td>
                                  <td>{{ $permiso->slug }}</td>
                                  <td>{{ $permiso->description }}</td>
                                  @can('permissions.edit')
                                    <td>
                                        <a href="{{ route('permissions.edit', $permiso->id) }}" class="btn btn-sm btn-warning">
                                             <i class="fa fa-pen"></i>
                                        </a>
                                    </td>
                                  @endcan
                                  @can('permissions.destroy')
                                    <td>    
                                        {!! Form::open(['route' => ['permissions.destroy', $permiso->id], 'method' => 'DELETE']) !!}
                                            <button class="btn btn-sm btn-danger" onclick="return confirm('¿ ESTAS SEGURO QUE DESEAS ELIMINAR ?')"><i class="fa fa-trash" ></i></button>
                                        {!! Form::close() !!}
                                    </td>                               
                                  @endcan
                              </tr>
                          @endforeach
                      </tbody>
                    </table>
                  </div>

                  {!! $permisos->render() !!}
        </div>
    </div>
</div>       
@endsection