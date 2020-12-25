@extends('layouts.app')

@section('title', 'Empresas')

@section('content')

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Empresas</h3>
                 <br>
                  <div>               
                      @can('empresas.create')
                          <a href="{{ route('empresas.create') }}" class="btn btn-sm btn-primary pull-right">Agregar empresa</a>
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
      
                  {!! Form::open(['route' => 'empresas.index', 'method' => 'GET', 'class' => 'navbar-form navbar-left', 'role' => 'search']) !!}
                    
                    <div class="form-group">
                        <div class="row">                       
                            
                            {!! Form::text('search', null, ['class' => 'form-control col-lg-6', 'placeholder' => 'Buscar por nombre de la empresa']) !!}                                                       
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
                                @if(Auth::user()->can('empresas.edit') || Auth::user()->can('empresas.destroy'))
                                     <th colspan="2">Acciones</th>
                                @endif
                            </tr>
                        </thead>
                      <tbody>
                          @foreach ($empresas as $key => $empresa)
                              <tr>
                                  <td>{{ ($key + 1) }}</td>
                                  <td>{{ $empresa->nombre_empresa }}</td>
                                  <td>{{ $empresa->descripcion_empresa }}</td>
                                  <td>{{ $empresa->created_at }}</td>
                                  <td>{{ $empresa->updated_at}}</td>
                                 
                                  @can('empresas.edit')
                                    <td>
                                        <a href="{{ route('empresas.edit', $empresa->id) }}" class="btn btn-sm btn-warning">
                                             <i class="fa fa-pen"></i>
                                        </a>
                                    </td>
                                  @endcan
                                  
                                  @can('empresas.destroy')
                                    <td>    
                                        {!! Form::open(['route' => ['empresas.destroy', $empresa->id], 'method' => 'DELETE']) !!}
                                            <button class="btn btn-sm btn-danger" onclick="return confirm('¿ ESTAS SEGURO QUE DESEAS ELIMINAR ?')"><i class="fa fa-trash" ></i></button>
                                        {!! Form::close() !!}
                                    </td>                               
                                  @endcan
                              </tr>
                          @endforeach
                      </tbody>
                    </table>
                  </div>

                  {!! $empresas->render() !!}
        </div>
    </div>
</div>       
@endsection