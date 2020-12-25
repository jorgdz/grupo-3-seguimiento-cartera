@extends('layouts.app')

@section('title', 'Campaña del cliente' )
@section('content')

    <div class="row">
        <div class="col-lg-12">

          	<pagos-component :id="{{ (string)$id }}"></pagos-component>

        </div>
    </div>

@endsection
