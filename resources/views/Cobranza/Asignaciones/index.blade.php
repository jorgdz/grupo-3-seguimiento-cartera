@extends('layouts.app')

@section('title', 'Asignaciones de Clientes')
@section('content')


<style>
    .container{
        margin-top: 10%;
    }
</style>

    @if ($errors->any())
        <div class="alert alert-danger">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if (Session::has('success'))
        <div class="alert alert-success">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
            <p>{{ Session::get('success') }}</p>
        </div>
    @endif
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Asignaciones de Clientes Cobranza</h5>
            <a href="{{ url('DESCARGARRESPALDO') }}"><button class="btn btn-success">Descargar Respaldo Anterior</button></a>
          <!--  <a href="{{ url('downloadData/xls') }}"><button class="btn btn-success">Descargar Excel xls</button></a>
            <a href="{{ url('downloadData/csv') }}"><button class="btn btn-info">Descargar CSV</button></a>
          -->
            <form style="border: 4px solid #a1a1a1;margin-top: 15px;padding: 10px;" action="{{ url('importAsignaciones') }}" class="form-horizontal" method="post" enctype="multipart/form-data">
                @csrf

                <input type="file" name="import_file" />
                <button class="btn btn-primary">Subir Asignacion</button>
            </form>

        </div>
    </div>
</div>
@endsection