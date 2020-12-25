@extends('layouts.app')

@section('title', 'Cargos')

@section('content')

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Cargos</h3>
                 <br>
                  <div>               
                      @can('cargos.create')
                          <a href="{{ route('cargos.create') }}" class="btn btn-sm btn-primary pull-right">Agregar cargos</a>
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
      
                  {!! Form::open(['route' => 'cargos.index', 'method' => 'GET', 'class' => 'navbar-form navbar-left', 'role' => 'search']) !!}
                    
                    <div class="form-group">
                        <div class="row">                       
                            
                            {!! Form::text('search', null, ['class' => 'form-control col-lg-6', 'placeholder' => 'Buscar por nombre del cargo']) !!}                                                       
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
                                <th>Nombre de cargo</th>
                                <th>Creación</th>
                                <th>Última actualización</th>

                                @if(Auth::user()->can('cargos.edit') || Auth::user()->can('cargos.destroy'))
                                     <th colspan="2">Acciones</th>
                                @endif

                            </tr>
                        </thead>
                      <tbody>
                          @foreach ($cargos as $key => $cargo)
                              <tr>
                                  <td>{{ ($key + 1) }}</td>
                                  <td>{{ $cargo->nombre_cargo }}</td>
                                  <td>{{ $cargo->created_at }}</td>
                                  <td>{{ $cargo->updated_at}}</td>
                                 
                                  @can('cargos.edit')
                                    <td>
                                        <a href="{{ route('cargos.edit', $cargo->id) }}" class="btn btn-sm btn-warning">
                                             <i class="fa fa-pen"></i>
                                        </a>
                                    </td>
                                  @endcan

                                  @can('cargos.destroy')
                                    <td>    
                                        {!! Form::open(['route' => ['cargos.destroy', $cargo->id], 'method' => 'DELETE']) !!}
                                            <button class="btn btn-sm btn-danger" onclick="return confirm('¿ ESTAS SEGURO QUE DESEAS ELIMINAR ?')"><i class="fa fa-trash" ></i></button>
                                        {!! Form::close() !!}
                                    </td>                               
                                  @endcan
                              </tr>
                          @endforeach
                      </tbody>
                    </table>
                  </div>

                  {!! $cargos->render() !!}
        </div>
    </div>
</div>       
@endsection