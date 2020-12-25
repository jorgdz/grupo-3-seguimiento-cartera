@extends('layouts.app')

@section('title', 'Procesos')

@section('content')

<div class="card-body" style="color:red;">
        {!! Form::open(['route' => 'vicidial.pre']) !!}

        <div class="form-group">

            {{ form::label('lotes', 'BUSCAR ESTADOS CERRADOS DE: ') }}
            <select name="lotes" class="browser-default custom-select" class="form-control{{ $errors->has('lotes') ? ' is-invalid' : ''  }}" autofocus required >
                <option value="">-- BUSCAR DEL LOTE--</option>
                @foreach ($lotes as $lotess)
                    <option value="{{ $lotess->list_id }}">{{ $lotess->list_id }} {{ $lotess->list_name }}</option>
                @endforeach
                @if ($errors->has('lotes'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('lotes') }}</strong>
                    </span>
                @endif
            </select>
            </div>
            <div class="form-group">

            {{ form::label('lotes', 'SACAR ESTADOS CERRADOS DE: ') }}
            <select name="lotes2" class="browser-default custom-select" class="form-control{{ $errors->has('lotes2') ? ' is-invalid' : ''  }}" autofocus required >
                <option value="">-- SACAR DEL LOTE--</option>
                @foreach ($lotes as $lotess)
                    <option value="{{ $lotess->list_id }}">{{ $lotess->list_id }} {{ $lotess->list_name }}</option>
                @endforeach
                @if ($errors->has('lotes'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('lotes') }}</strong>
                    </span>
                @endif
            </select>
            </div>
            <div class="col-sm-3">
                <div class="form-group">
                {!! Form::label('marca' , 'Marca'); !!}
                {!! Form::text('marca' , null, ['class' =>'form-control',  'placeholder' => '0, BD...' , 'required' ]); !!}
                </div>
            </div>
            
            <div class="form-group">
                {{ form::submit('PROCESAR', ['class' => 'btn btn-sm btn-primary']) }}
                <a  href="{{ route('procesos.index') }}" class="btn btn-success btn-sm active" role="button"> Volver </a>
            </div>
        {!! Form::close() !!}
     
</div>


@endsection