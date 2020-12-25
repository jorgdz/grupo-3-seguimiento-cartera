@extends('layouts.app')

@section('title', 'Campaña de clientes' )
@section('content')

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-lg-3">
                            <span><strong>Identificación:</strong> {{ $detalleCampania->cliente->cedula }} </span>
                        </div>
                        <div class="col-lg-3">
                            <span><strong>Cliente:</strong> {{ $detalleCampania->cliente->nombres }} {{ $detalleCampania->cliente->apellidos }} </span>
                        </div>
                        <div class="col-lg-3">
                            <span><strong>Celular:</strong> {{ $detalleCampania->cliente->celular }} </span>
                        </div> 
                        <div class="col-lg-3">
                            <span><strong>Dirección:</strong> {{ $detalleCampania->cliente->direccion }} </span>
                        </div>
                    </div>
                    <div class="row" style="background-color:crimson; color: white;">   
                         <div class="col-lg-3">
                            <span><strong>Campaña:</strong> {{ $detalleCampania->campania->nombre_campania }} </span>
                        </div>  
                        <div class="col-lg-3">
                            <span><strong>Deuda:</strong> {{ $detalleCampania->valor_deuda }} </span>
                        </div>  
                        <div class="col-lg-3">
                            <span><strong>Saldo:</strong> {{ ($detalleCampania->valor_saldo < 0.1) ? 0 : $detalleCampania->valor_saldo}} </span>
                        </div> 
                    </div>
                    <br>                
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

                    @if (count($errors) > 0)
                        <div class="alert alert-danger alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <h5><i class="icon fas fa-exclamation-triangle"></i>Error</h5>  
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li> {{ $error }} </li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>

                <div class="card-body">
                    {!! Form::model($detalleCampania, ['route' => ['pagos.update', $detalleCampania->id], 'method' => 'PUT']) !!}
                    <div class="row">
                        <div class="col-lg-6">
                            
                            <div class="form-group">
                                {{ Form::label('abono', 'Abono ($)') }}
                                {{ Form::text('abono', null, ['class' => 'form-control', 'placeholder' => 'Ingrese el abono']) }}
                            </div>

                            <div class="form-group">
                                {{ Form::label('periodo', 'Periodos de pago (meses)') }}
                                {{ Form::text('periodo', null, ['class' => 'form-control', 'placeholder' => 'Ingrese el periodo de pago']) }}
                            </div>

                            <div class="form-group">
                                {{ Form::label('interes', 'Interés (%)') }}
                                {{ Form::text('interes', null, ['class' => 'form-control', 'placeholder' => 'Ingrese el Interés']) }}
                            </div>        

                        </div>
                        <div class="col-lg-6">                    
                            <div class="form-group">
                                {{ Form::label('fecha_pago', 'Fecha en la que realizará el primer pago') }}
                                {{ Form::date('fecha_pago', null, ['class' => 'form-control']) }}
                            </div>
                           
                            <div class="card-footer">
                                {{ Form::submit('Enviar', ['class' => 'btn btn-sm btn-primary']) }}
                            </div>
                        </div>
                    </div>             
                    {!! Form::close() !!}

                    <div class="row">
                        <h5><strong>Plan de pago</strong></h5>
                        <div class="table-responsive"> 
                            <table class="table table-bordered table-hover table-striped ">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                       <th>Periodo</th>
                                        <th>Interés</th>
                                        <th>Cuota</th>
                                        <th>Abono</th>     
                                        <th>Fecha de pago</th>     
                                        <th colspan="2">Acciones</th>     
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($detalleCampania->pagos as $key => $pago)
                                    <tr>
                                        <td>{{ ($key + 1) }}</td>
                                        <td>{{ $pago->periodo }} mes(es)</td>
                                        <td>{{ $pago->interes }} %</td>
                                        <td>${{ round($pago->cuota, 2) }}</td>
                                        <td>${{ $pago->abono }}</td>
                                        <td>{{ $pago->fecha_pago }}</td>
                                
                                        <td>    
                                            <a href="{{ route('pagos.detalles', $pago->id) }}" class="btn btn-sm btn-info"><i class="fa fa-eye"></i></a>
                                        </td>
                                        <td>    
                                            {!! Form::open(['route' => ['pagos.destroy', $pago->id], 'method' => 'DELETE']) !!}
                                                <button class="btn btn-sm btn-danger" onclick="return confirm('¿ ESTAS SEGURO QUE DESEAS ELIMINAR ?')"><i class="fa fa-trash" ></i></button>
                                            {!! Form::close() !!}
                                        </td>

                                    </tr>
                                @endforeach
                              </tbody>         
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
