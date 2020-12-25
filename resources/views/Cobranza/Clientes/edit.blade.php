
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

                    <h1 class="card-title">Cliente </h1>
                    <br>    
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
                </div>
                
                <div class="card-body">
                     
                    {!! Form::model($datos, ['route' => ['clientes.update', $datos->IdCampaña,$datos->Identificacion],
                    'method' => 'PATCH']) !!}
                    
                        @include('Cobranza.Clientes.partial.form')

                    {!! Form::close() !!}
                </div>
                <h2>Pagos</h2>
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
                            <td>{{ Carbon\Carbon::parse($pago->FecRegistro)->format('d-m-Y ') }}</td> 
                            <td>{{ $pago->UsuConfirmacion }}</td>  
                            <td WIDTH="50%">{{ $pago->Notas }}</td>   
                        </tr>
                        @endforeach
                        </tbody>
                    </table>    
                </div>
            </div>
        </div>
    </div>

@endsection

