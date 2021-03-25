<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <style>
        .logo-estudio {
            width: 100px;
            height: 100px;
            border-radius: 250%;
            position: absolute;
            margin-left:25px;
            margin-top: -12px;
        }

        @page {
            margin: 0cm 0cm;
            font-family: Arial;
        }
        body {
            margin: 3cm 2cm 2cm;
            font-family: 'sans-serif';
        }
        header {
            margin-top:20px;
            position: fixed;
            top: 0cm;
            left: 0cm;
            font-family: 'sans-serif';
            right: 0cm;
            height: 2cm;
            background-color: #897853;
            color: white;
            line-height: 30px;
        }
        footer {
            position: fixed;
            bottom: 0cm;
            left: 0cm;
            right: 0cm;
            height: 2cm;
            background-color: #897853;
            color: white;
            text-align: center;
            line-height: 35px;
        }
        /* ESTILOS DE TABLA */
        table {
            border-collapse: collapse;
        }
        .table {
            width: 100%;
            margin-bottom: 1rem;
            color: #212529;
        }
        .table th,
        .table td {
            padding: 0.75rem;
            vertical-align: top;
            border-top: 1px solid #dee2e6;
        }
        .table thead th {
            vertical-align: bottom;
            border-bottom: 2px solid #dee2e6;
        }
        .table tbody+tbody {
            border-top: 2px solid #dee2e6;
        }
        .table-sm th,
        .table-sm td {
            padding: 0.3rem;
        }
        .table-bordered {
            border: 1px solid #dee2e6;
        }
        .table-bordered th,
        .table-bordered td {
            border: 1px solid #dee2e6;
        }
        .table-bordered thead th,
        .table-bordered thead td {
            border-bottom-width: 2px;
        }
        .table-borderless th,
        .table-borderless td,
        .table-borderless thead th,
        .table-borderless tbody+tbody {
            border: 0;
        }
        .table-striped tbody tr:nth-of-type(odd) {
            background-color: rgba(0, 0, 0, 0.05);
        }
        .table-hover tbody tr:hover {
            color: #212529;
            background-color: rgba(0, 0, 0, 0.075);
        }
        .table-primary,
        .table-primary>th,
        .table-primary>td {
            background-color: #c6e0f5;
        }
        .table-primary th,
        .table-primary td,
        .table-primary thead th,
        .table-primary tbody+tbody {
            border-color: #95c5ed;
        }
        .table-hover .table-primary:hover {
            background-color: #b0d4f1;
        }
        .table-hover .table-primary:hover>td,
        .table-hover .table-primary:hover>th {
            background-color: #b0d4f1;
        }
        .table-secondary,
        .table-secondary>th,
        .table-secondary>td {
            background-color: #d6d8db;
        }
        .table-secondary th,
        .table-secondary td,
        .table-secondary thead th,
        .table-secondary tbody+tbody {
            border-color: #b3b7bb;
        }
        .table-hover .table-secondary:hover {
            background-color: #c8cbcf;
        }
        .table-hover .table-secondary:hover>td,
        .table-hover .table-secondary:hover>th {
            background-color: #c8cbcf;
        }
        .table-success,
        .table-success>th,
        .table-success>td {
            background-color: #c7eed8;
        }
        .table-success th,
        .table-success td,
        .table-success thead th,
        .table-success tbody+tbody {
            border-color: #98dfb6;
        }
        .table-hover .table-success:hover {
            background-color: #b3e8ca;
        }
        .table-hover .table-success:hover>td,
        .table-hover .table-success:hover>th {
            background-color: #b3e8ca;
        }
        .table-info,
        .table-info>th,
        .table-info>td {
            background-color: #d6e9f9;
        }
        .table-info th,
        .table-info td,
        .table-info thead th,
        .table-info tbody+tbody {
            border-color: #b3d7f5;
        }
        .table-hover .table-info:hover {
            background-color: #c0ddf6;
        }
        .table-hover .table-info:hover>td,
        .table-hover .table-info:hover>th {
            background-color: #c0ddf6;
        }
        .table-warning,
        .table-warning>th,
        .table-warning>td {
            background-color: #fffacc;
        }
        .table-warning th,
        .table-warning td,
        .table-warning thead th,
        .table-warning tbody+tbody {
            border-color: #fff6a1;
        }
        .table-hover .table-warning:hover {
            background-color: #fff8b3;
        }
        .table-hover .table-warning:hover>td,
        .table-hover .table-warning:hover>th {
            background-color: #fff8b3;
        }
        .table-danger,
        .table-danger>th,
        .table-danger>td {
            background-color: #f7c6c5;
        }
        .table-danger th,
        .table-danger td,
        .table-danger thead th,
        .table-danger tbody+tbody {
            border-color: #f09593;
        }
        .table-hover .table-danger:hover {
            background-color: #f4b0af;
        }
        .table-hover .table-danger:hover>td,
        .table-hover .table-danger:hover>th {
            background-color: #f4b0af;
        }
        .table-light,
        .table-light>th,
        .table-light>td {
            background-color: #fdfdfe;
        }
        .table-light th,
        .table-light td,
        .table-light thead th,
        .table-light tbody+tbody {
            border-color: #fbfcfc;
        }
        .table-hover .table-light:hover {
            background-color: #ececf6;
        }
        .table-hover .table-light:hover>td,
        .table-hover .table-light:hover>th {
            background-color: #ececf6;
        }
        .table-dark,
        .table-dark>th,
        .table-dark>td {
            background-color: #c6c8ca;
        }
        .table-dark th,
        .table-dark td,
        .table-dark thead th,
        .table-dark tbody+tbody {
            border-color: #95999c;
        }
        .table-hover .table-dark:hover {
            background-color: #b9bbbe;
        }
        .table-hover .table-dark:hover>td,
        .table-hover .table-dark:hover>th {
            background-color: #b9bbbe;
        }
        .table-active,
        .table-active>th,
        .table-active>td {
            background-color: rgba(0, 0, 0, 0.075);
        }
        .table-hover .table-active:hover {
            background-color: rgba(0, 0, 0, 0.075);
        }
        .table-hover .table-active:hover>td,
        .table-hover .table-active:hover>th {
            background-color: rgba(0, 0, 0, 0.075);
        }
        .table .thead-dark th {
            color: #fff;
            background-color: #343a40;
            border-color: #454d55;
        }
        .table .thead-light th {
            color: #495057;
            background-color: #e9ecef;
            border-color: #dee2e6;
        }
        .table-dark {
            color: #fff;
            background-color: #343a40;
        }
        .table-dark th,
        .table-dark td,
        .table-dark thead th {
            border-color: #454d55;
        }
        .table-dark.table-bordered {
            border: 0;
        }
        .table-dark.table-striped tbody tr:nth-of-type(odd) {
            background-color: rgba(255, 255, 255, 0.05);
        }
        .table-dark.table-hover tbody tr:hover {
            color: #fff;
            background-color: rgba(255, 255, 255, 0.075);
        }
        @media (max-width: 575.98px) {
            .table-responsive-sm {
                display: block;
                width: 100%;
                overflow-x: auto;
                -webkit-overflow-scrolling: touch;
            }
            .table-responsive-sm>.table-bordered {
                border: 0;
            }
        }
        @media (max-width: 767.98px) {
            .table-responsive-md {
                display: block;
                width: 100%;
                overflow-x: auto;
                -webkit-overflow-scrolling: touch;
            }
            .table-responsive-md>.table-bordered {
                border: 0;
            }
        }
        @media (max-width: 991.98px) {
            .table-responsive-lg {
                display: block;
                width: 100%;
                overflow-x: auto;
                -webkit-overflow-scrolling: touch;
            }
            .table-responsive-lg>.table-bordered {
                border: 0;
            }
        }
        @media (max-width: 1199.98px) {
            .table-responsive-xl {
                display: block;
                width: 100%;
                overflow-x: auto;
                -webkit-overflow-scrolling: touch;
            }
            .table-responsive-xl>.table-bordered {
                border: 0;
            }
        }
        .table-responsive {
            display: block;
            width: 100%;
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
        }
        .table-responsive>.table-bordered {
            border: 0;
        }
    </style>
    <title>Reporte de cuotas canceladas</title>
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <header>
        <img class="logo-estudio" src="estudio.jpg" alt="">
        <h1 align="center">ESTUDIO JURÍDICO MEDINA Y ASOCIADOS</h1>
    </header>
    <div class="container">
        <p style="color:crimson; text-transform: uppercase;"><strong>{{($detalles['pago']->periodo - $detalles['cuotas_pagadas'])}} cuotas pendientes de {{$detalles['pago']->periodo}} pagos en total.</strong></p>
        <hr>
        <p><b>Dirección: </b><span>Tungurahua y 9 de octubre</span> <span><b>*Telf:</b> 052-741581</span><span><b> *Cels: </b>096382201</span></b></p>
        <hr>
        <p><b>Fecha: </b><span>{{ date('Y-m-d') }}</span></p>
    </div>
    <div class="container">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th scope="col">Estado de pago</th>
                    <th scope="col">Saldo inicial</th>
                    <th scope="col">Cuota fija</th>
                    <th scope="col">Fecha de pago</th>
                </tr>
            </thead>
            <tbody>
                @foreach($detalles['detallesPagos'] as $key => $amortizacion)
                <tr>
                    <td align="center">
                        @if($amortizacion->fecha_pago < date('Y-m-d') && $amortizacion->cuota_fija < round($detalles['pago']->cuota, 4))
												
                            <span class="badge badge-danger">Incumplido</span>

                        @elseif($amortizacion->fecha_pago > date('Y-m-d') && $amortizacion->cuota_fija < round($detalles['pago']->cuota, 4))
                            
                            <span class="badge badge-info">Pendiente</span>

                        @else
                            
                            <span class="badge badge-success">Cancelado</span>

                        @endif
                    </td>
                    <td align="center">
                        ${{ round($amortizacion->saldo_inicial, 4) }}
                    </td>
                    <td align="center">
                        ${{ round($amortizacion->cuota_fija, 4) }}
                    </td>
                    <td align="center">
                        {{ date('d-M-Y', strtotime($amortizacion->fecha_pago))}}
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    </div>
</body>

</html>