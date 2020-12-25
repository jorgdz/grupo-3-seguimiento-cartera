@extends('layouts.app')

@section('title', 'Crear usuario')
@section('content')
    
    <div class="row">
        <div class="col-lg-12">
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
                                
                            </ul>
                        </div>
                    @endif

                    <h1 class="card-title">Agente</h1>
                    <br>                
                </div>
                
                <div class="card-body">
                     
                    {!! Form::model($agentes, ['route' => ['puestos.update', $agentes->user],
                    'method' => 'PATCH']) !!}
                    
                        @include('Predictivo.puesto.partial.form')

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>

@endsection

