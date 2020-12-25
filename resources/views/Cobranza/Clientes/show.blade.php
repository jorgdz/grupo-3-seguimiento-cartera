
@extends('layouts.app')

@section('title', 'Actualizar CLIENTE')
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
                </div>
                <section class="col-lg-12 connectedSortable">
                <div class="alert alert-primary" role="alert">
                    <center> <strong>Cliente Detalle</strong> </center>    
                </div>

                <table class="table table-hover table-condensed">
                    <thead>
                        <th>Cedula</th>
                        <th>Nombres</th>
                        <th>Deuda</th>
                        <th>Saldo</th>
                        <th>Area</th>
                        <th>Agente</th>
                    </thead>
                    <tbody>
                        <td>{{ $datos->Identificacion }}</td>    
                        <td>{{ $datos->Nombres }}</td>  
                        <td>{{ $datos->ValorDeuda }}</td>  
                        <td>{{ $datos->SaldoDeuda }}</td> 
                        <td>{{ $datos->Campo9 }}</td>  
                        <td>{{ $datos->IdAgente }}</td>   
                    </tbody>
                </table>
            </section>
            </div> 
        </div> 
    </div>   
       

    <div class="row">    
        <section class="col-lg-6 connectedSortable">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="ion ion-clipboard mr-1"></i>
                            Direcciones
                        </h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <ul class="todo-list">
                                @foreach ($direciones as $direcione)
                            <li>
                                <!-- drag handle -->
                                <span class="handle">
                                    <i class="fas fa-ellipsis-v"></i>
                                    <i class="fas fa-ellipsis-v"></i>
                                </span>
                                <!-- checkbox -->
                                <div  class="icheck-primary d-inline ml-2">
                                    
                                    <label for="todoCheck1"></label>
                                </div>
                         
                            <!-- todo text -->
                            <span class="text">{{ $direcione->Direccion }}</span>
                        </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </section>
            <section class="col-lg-6 connectedSortable">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">
                                <i class="ion-ios-telephone mr-1"></i>
                                Telefonos
                            </h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <ul class="todo-list">
                                    @foreach ($telefonos as $telefono)
                                <li>
                                    <!-- drag handle -->
                                    <span class="handle">
                                        <i class="fas fa-ellipsis-v"></i>
                                        <i class="fas fa-ellipsis-v"></i>
                                    </span>
                                    <!-- checkbox -->
                                    <div  class="icheck-primary d-inline ml-2">
                                        
                                    <label for="todoCheck1"></label>
                                    </div>
                                
                                <!-- todo text -->
                                <span class="text">{{ $telefono->TelefonoPersona }}  {{ $telefono->NombreReferencia }}</span>
                                </li>
                                @endforeach
                            </ul>
                           
                        </div>
                    </div>
                </section>
    </div>
@if ($detallecuotas != '0')
    

    <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="alert alert-success " role="alert">
                        <center> <strong>Cuotas Detalle</strong> </center>    
                    </div>
                    <section class="col-lg-12 connectedSortable">
                    <table class="table table-hover table-condensed table-bordered">
                        <thead class="thead-dark">
                            <th>#</th>
                            <th>Fecha Vence</th>
                            <th>Valor</th>
                            <th>Saldo</th>
                            <th>Stado</th>
                            <th>Agente Registra</th>
                            <th>Fecha Registro</th>
                            <th>Fecha Pago</th>
                            <th>Agente Confirma</th>
                        </thead>
                        <tbody class="table-striped ">
                                @foreach ($detallecuotas as $detallecuota)
                            <tr>
                                <td>{{ $detallecuota->IdCampañaPersonaCuotaDetalle }}</td> 
                                <td>{{ Carbon\Carbon::parse($detallecuota->FechaVence)->format('d-m-Y ') }}</td>  
                                <td>{{ $detallecuota->Monto }}</td>
                                <td>{{ $detallecuota->Saldo }}</td> 
                                @if ($detallecuota->Saldo <= 0)
                                    <td><span class="badge bg-success">Cancelado</span></td>
                                @elseif ($detallecuota->Saldo > 0 && $detallecuota->Saldo < $detallecuota->Monto)
                                    <td><span class="badge bg-warning">Incompleta</span></td>
                                @else
                                <td><span class="badge bg-danger">Pendiente</span></td>
                                @endif 
                                <td>{{ $detallecuota->UsuEdicion }}</td>
                                <td>{{ Carbon\Carbon::parse($detallecuota->FecEdicion)->format('d-m-Y ') }}</td>   
                                <td>{{ Carbon\Carbon::parse($detallecuota->FecIngPago)->format('d-m-Y ') }}</td>  
                                <td>{{ $detallecuota->UsuIngPago }}</td>  
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    </section>  
                </div>
            </div>
        </div>

        @else
        <div class="alert alert-danger " role="alert">
                <center> <strong><i class="fas fa-exclamation-triangle"></i>SIN PLAN DE CUOTAS<i class="fas fa-exclamation-triangle"></i></strong> </center>    
            </div>
        @endif



    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="alert alert-success " role="alert">
                    <center> <strong>Pagos Detalle</strong> </center>    
                </div>
                <section class="col-lg-12 connectedSortable">
                <table class="table table-hover table-condensed table-bordered">
                    <thead class="thead-dark">
                        <th>IDP</th>
                        <th>Valor</th>
                        <th>Registra</th>
                        <th>Fecha</th>
                        <th>Confirma</th>
                        <th>Notas</th>
                    </thead>
                    <tbody class="table-striped ">
                            @foreach ($pagos as $pago)
                        <tr>
                            <td>{{ $pago->IdCampañaPersonaPago }}</td>    
                            <td>{{ $pago->Valor }}</td>  
                            <td>{{ $pago->UsuRegistro }}</td>
                            <td>{{ Carbon\Carbon::parse($pago->FecRegistro)->format('d-m-Y ')  }}</td> 
                            <td>{{ $pago->UsuConfirmacion }}</td>  
                            <td WIDTH="25%">{{ $pago->Notas }}</td>   
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                </section>  
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
            <div class="alert alert-warning   " role="alert">
                <center> <strong>Gestiones Detalle</strong> </center>    
            </div>
                <section class="col-lg-12 connectedSortable">
                <table class="table table-striped">
                    <thead class="thead-dark">
                        
                        <th>Fecha</th>
                        <th>Agente</th>
                        <th>Telefono</th>
                        <th>Estado</th>
                        <th WIDTH="25%">Comentario</th>
                        <th>Valor</th>
                        <th>Promesa</th>
                    </thead>
                    <tbody class="table-striped ">
                        @foreach ($gestiones as $gestion)
                        <tr>
                        <td>{{  Carbon\Carbon::parse($gestion->FecRegistro)->format('d-m-Y ')  }}</td>
                        <td>{{ $gestion->UsuRegistro }}</td>
                        <td>{{ $gestion->TelefonoPersona }}</td>    
                        <td>{{ $gestion->Descripcion }}</td>  
                        <td>{{ $gestion->Comentario }}</td> 
                        <td>{{ $gestion->PromesaMontoPago }}</td> 
                        
                        <td>{{ Carbon\Carbon::parse($gestion->PromesaPago)->format('d-m-Y ')  }}</td>   
                    </tr>
                    @endforeach
                    </tbody>
                </table> 
                </section>  
            </div>
        </div>
    </div>
        {!! $gestiones->render() !!} 
                <center>        @can('clientes.edit') <a href="{{route('clientes.edit', [$datos->IdCampaña , $datos->Identificacion])}}" class="btn btn-sm btn-danger ">Actualizar</a> @endcan  &nbsp;&nbsp;&nbsp;&nbsp; <a href="{{ route('clientes.index') }}" class="btn btn-success btn-sm">Volver</a></center> 
            
    @endsection

