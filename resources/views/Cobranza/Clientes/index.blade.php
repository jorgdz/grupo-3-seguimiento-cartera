@extends('layouts.app')

@section('title', 'Clientes | Cobranza')
@section('content')


    <div class="d-inline-block align-top" class="col-md-6" > 
                    
        {!! Form::open(['route'=> 'clientes.index', 'method' => 'GET', 'class' => 'form-inline pull-right']) !!}
        
            {{ Form::text('cedula', null, ['class' => 'form-control', 'placeholder' => 'Cedula']) }}
            {{ Form::text('nombres', null, ['class' => 'form-control', 'placeholder' => 'Nombres']) }}
            {{ Form::text('agente', null, ['class' => 'form-control', 'placeholder' => 'Agente']) }}
            
           
                <button type='submit' class='btn btn-default'>
                <span class="glyphicon glyphicon-search">BUSCAR</span>
                </button>
        {!! Form::close() !!}
<br>
    </div>


           
    <table class="table table-hover table-condensed">
            <thead class="thead-dark">
            <th class='text-center' >id</th>
            <th class='text-center'>Campaña</th> 
            <th class='text-center'>Agente</th> 
            <th class='text-center'>Area</th>
            <th class='text-center' >Cedula</th>    
            <th  class='text-center'>Nombres</th>
            <th class='text-center'>Deuda </th>
            <th class='text-center'>Saldo </th>
    
            <center><th  class='text-center' COLSPAN="6">Accion</th></center>
            </thead>
            <tbody >
          
            @foreach ($clientes as $cliente)
            
            <tr > 
                <td class='text-center'  ><small class="text-muted"> {{ $cliente->IdCampaña . $cliente->Identificacion }} </small></td>
                <td class='text-center'  ><small class="text-muted"> {{ $cliente->Descripcion }}</small></td>
                <td class='text-center'  ><small class="text-muted"> {{ $cliente->IdAgente }}</small></td>
                <td class='text-center'  ><small class="text-muted"> {{ $cliente->Campo9 }}</small></td>
                <td class='text-center'  ><small class="text-muted"> {{ $cliente->Identificacion }}</small></td>
                <td class='text-center'  ><small class="text-muted"> {{ $cliente->Nombres }} </small></td>
                <td class='text-center'  ><small class="text-muted"> {{ $cliente->ValorDeuda }}</small></td>
                <td class='text-center'  ><small class="text-muted"> {{ $cliente->SaldoDeuda }}</small></td>
                @can('clientes.edit')
                <td>    
                    <a href="{{route('clientes.edit', [$cliente->IdCampaña , $cliente->Identificacion])}}" class="btn btn-sm btn-danger"><i class="fas fa-edit"></i>
                    </a>
                </td>  
                @endcan 
                <td>    
                    <a href="{{route('clientes.show', [$cliente->IdCampaña , $cliente->Identificacion])}}" class="btn btn-sm btn-success"><i class="fa fa-eye"></i>
                    </a>
                </td> 
            </tr>
            
            @endforeach

            </tbody> 
         </table>

          {!! $clientes->render() !!}

          <hr>
          <div class="col-md-6">
            <div class="card">
                    <div class="card-header">
                    <h3 class="card-title">ESTADOS DE LAS CARTERAS</h3>
                    </div>
                <div class="card-body p-0">
                    <table class="table table-striped">
                        <tr>
                        <th class='text-center' >Area</th>
                        <th class='text-center'>Clientes</th> 
                        <th style="width: 40px">#</th>
                        </tr>
                        <?php $sum = 0; ?>
                        @foreach ($cartera as $carteras)
                        <?php $sum += $carteras->clientes; ?>
                        <tr>
                        <td class='text-center'  ><small class="text-muted"> {{ $carteras->area}} </small></td>
                        <td class='text-center'  ><small class="text-muted"> {{ $carteras->clientes }}</small></td>
                        
                        <td>    
                            <a href="{{route('clientes.cartera', [$carteras->area] )}}" class="btn btn-sm btn-success"><i class="fa fa-eye"></i>
                            </a>
                        </td> 
                    
                        </tr>
                        @endforeach
                        <td class='text-center'  ><small class="text-muted"> <H3>TOTAL ---  {{ $sum }}   </H3> </small></td>
                    </table>
                </div>
            </div>
        </div>
@endsection