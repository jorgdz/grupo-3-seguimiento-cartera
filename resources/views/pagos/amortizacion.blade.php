@extends('layouts.app')

@section('title', 'Amortización de '.$pago->detalleCampania->campania->nombre_campania )
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
                    {!! Form::open(['route' => 'amortizacion.store']) !!}
                    	<input type="hidden" name="pago_id" value="{{ $pago->id }}">

                    	{{ Form::label('abono', 'Valor de la cuota ($)') }}
                    	: Su valor de la cuota mensual es: <strong>{{ round($pago->cuota, 4) }}</strong>
                    	<p><em>Valor con todos los decimales: {{ $pago->cuota }}</em></p>
                    	<p><em>Saldo de la deuda: <strong>{{ ($pago->detalleCampania->valor_saldo < 0.001) ? 0 : $pago->detalleCampania->valor_saldo}}</strong> </em></p>
                    	<div class="col-lg-10">
	                        <div class="form-group">
                            	<div class="row">                    
	                                {{ Form::text('cuota_fija', null, ['class' => 'form-control col-lg-8', 'placeholder' => 'Ingrese el valor de la cuota']) }}
	                                {{ Form::submit('Enviar', ['class' => 'btn btn-sm btn-primary']) }}
	                            </div>
                            </div>                          
               	 		</div>    

                    {!! Form::close() !!}

                    <div class="row">
                        <h5><strong>Tabla de amortización</strong></h5>
                        <div class="table-responsive"> 
                            <table class="table table-bordered table-hover table-striped ">
                                <thead>
                                    <tr>
                                        <th># Periodos</th>
                                       	<th>Saldo inicial</th>
                                        <th>Cuota fija</th>
                                        <th>Interes</th>
                                        <th>Abono al capital</th>     
                                        <th>Saldo final</th>                                     
                                        <th>Fecha de pago</th>                                     
                                        <th>Estado de pago</th>                                     
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($pago->detallePagos as $key => $amortizacion)
                                    <tr>
                                        <?php $interes = ($amortizacion->saldo_inicial * ($pago->interes / 100)) ?>
                                        <?php $capital = $amortizacion->cuota_fija - $interes ?>

                                        <td>{{ ($key + 1) }}</td>
                                        <td>${{ $amortizacion->saldo_inicial }}</td>
                                        <td>${{ $amortizacion->cuota_fija }}</td>
                                        <td>${{ $interes }} </td>
                                        <td>${{ $capital }}</td>
                                        <td>${{ (($amortizacion->saldo_inicial - $capital) < 0.1) ? 0 : ($amortizacion->saldo_inicial - $capital) }}</td>                           
                                        <td>{{ date('d-M-Y', strtotime($amortizacion->fecha_pago))}}</td>                           
                                        <td>
                                        	
                                        	@if($amortizacion->fecha_pago < date('Y-m-d') && $amortizacion->cuota_fija < round($pago->cuota, 4))
												
												<span class="badge badge-danger">Incumplido</span>

											@elseif($amortizacion->fecha_pago > date('Y-m-d') && $amortizacion->cuota_fija < round($pago->cuota, 4))
												
												<span class="badge badge-info">Pendiente</span>

											@else
												
												<span class="badge badge-success">Al día</span>

                                        	@endif

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
