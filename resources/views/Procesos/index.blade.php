@extends('layouts.app')

@section('title', 'Procesos')

@section('content')

<div class="container-fluid">
    <div class="row">
        
        <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box">
                <span class="info-box-icon bg-danger"><a href="{{ route('porcesos.log_lis') }}" onclick="return confirm('¿ ESTAS SEGURO QUE DESEAS EJECUTAR ?')"><i class="fas fa-skull-crossbones"></i></a></span>
                <div class="info-box-content">
                    <span class="info-box-text">Procesos </span>
                    <span class="info-box-number">Del predictivo al Server 192.168.1.75 => 192.168.1.7</span>
                </div>
            </div>
        </div>

        <div class="col-md-3 col-sm-6 col-12">
                <div class="info-box">
                        <span class="info-box-icon bg-success"><a href="{{ route('porcesos.estadoscerrados') }}" onclick="return confirm('¿ ESTAS SEGURO QUE DESEAS EJECUTAR ?')"><i class="fas fa-bezier-curve"></i></a></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Procesos </span>
                        <span class="info-box-number">Del predictivo al Server 192.168.1.7</span>
                    </div>
                </div>
            </div>

    </div>
</div>


@endsection