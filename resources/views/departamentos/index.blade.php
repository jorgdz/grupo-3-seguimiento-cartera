@extends('layouts.app')

@section('title', 'Departamentos')

@section('content')

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Departamentos</h3>
                 <br>
                  <div>               
                      @can('departamentos.create')
                          <a href="{{ route('departamentos.create') }}" class="btn btn-sm btn-primary pull-right">Agregar departamento</a>
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
      
                  {!! Form::open(['route' => 'departamentos.index', 'method' => 'GET', 'class' => 'navbar-form navbar-left', 'role' => 'search']) !!}
                    
                    <div class="form-group">
                        <div class="row">                       
                            
                            {!! Form::text('search', null, ['class' => 'form-control col-lg-6', 'placeholder' => 'Buscar por nombre o descripción del departamento']) !!}                                                       
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
                                <th>Nombre</th>
                                <th>Descripción</th>
                                <th>Creación</th>
                                <th>Última actualización</th>

                                @if(Auth::user()->can('departamentos.edit') || Auth::user()->can('departamentos.destroy'))
                                     <th colspan="2">Acciones</th>
                                @endif
                                
                            </tr>
                        </thead>
                      <tbody>
                          @foreach ($departamentos as $key => $departamento)
                              <tr>
                                  <td>{{ ($key + 1) }}</td>
                                  <td>{{ $departamento->nombre_departamento }}</td>
                                  <td>{{ $departamento->descripcion_departamento }}</td>
                                  <td>{{ $departamento->created_at }}</td>
                                  <td>{{ $departamento->updated_at}}</td>
                                 
                                  @can('departamentos.edit')
                                    <td>
                                        <a href="{{ route('departamentos.edit', $departamento->id) }}" class="btn btn-sm btn-warning">
                                             <i class="fa fa-pen"></i>
                                        </a>
                                    </td>
                                  @endcan
                                  @can('departamentos.destroy')
                                    <td>    
                                        {!! Form::open(['route' => ['departamentos.destroy', $departamento->id], 'method' => 'DELETE']) !!}
                                            <button class="btn btn-sm btn-danger" onclick="return confirm('¿ ESTAS SEGURO QUE DESEAS ELIMINAR ?')"><i class="fa fa-trash" ></i></button>
                                        {!! Form::close() !!}
                                    </td>                               
                                  @endcan
                              </tr>
                          @endforeach
                      </tbody>
                    </table>
                  </div>

                  {!! $departamentos->render() !!}
        </div>
    </div>
</div>       
@endsection