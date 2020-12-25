
<!-- campos ocultos para poder evitar ingresos null-->
<input type="hidden" name="Campo9" value="{{ $datos->Campo9 }}">
<input type="hidden" name="IdAgente" value="{{ $datos->IdAgente }}">
<input type="hidden" name="campana" value="{{ $datos->IdCampaña }}">

<!--
<div class="form-group">
        {{ form::label('Identificacion', 'Cedula') }}
        {{ form::text('Identificacion', null, ['class' => 'form-control','disabled']) }}
    </div>
    
<div class="form-group">
    {{ form::label('Nombres', 'Nombres') }}
    {{ form::text('Nombres', null, ['class' => 'form-control','disabled']) }}
</div>

<div class="form-group">
    {{ form::label('Campo9', 'Grupo Area') }}
    {{ form::text('Campo9', null, ['class' => 'form-control','disabled']) }}
</div>

<div class="form-group">
        {{ form::label('IdAgente', 'Agente') }}
        {{ form::text('IdAgente', null, ['class' => 'form-control','disabled']) }}
    </div>-->



<div class="form-group">
    {{ form::label('Campo92', 'Area ') }}
    <select name="Campo92" class="browser-default custom-select" class="form-control{{ $errors->has('user_group') ? ' is-invalid' : ''  }}" autofocus  >
    <option value="">---- Seleccionar un Area -----</option>
        @foreach ($areas as $area)

            <option value="{{ $area->Campo9 }}"> {{ $area->Campo9 }}</option>
        @endforeach
        @if ($errors->has('Campo92'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('Campo92') }}</strong>
            </span>
        @endif
    </select>
</div>

<div class="form-group">
    {{ form::label('IdPersona2', 'Nuevo   Asesor ') }}
    <select name="IdPersona2" class="browser-default custom-select" class="form-control{{ $errors->has('IdPersona2') ? ' is-invalid' : ''  }}" autofocus  >
    <option value="">---- Seleccionar un  Asesor -----</option>
        @foreach ($agentes as $agente)

            <option value="{{ $agente->IdPersona }}">{{ $agente->IdPersona }} </option>
        @endforeach
        @if ($errors->has('IdPersona2'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('IdPersona2') }}</strong>
            </span>
        @endif
    </select>
</div>


<center>
<div class="form-group">
    {{ form::submit('Actualizar', ['class' => 'btn btn-sm btn-primary']) }}

    <a href="{{ route('clientes.index') }}" class="btn btn-success btn-sm">Volver</a>
   
</div>
</center>