<div class="form-group">
    {{ form::label('user', 'user') }}
    {{ form::text('user', null, ['class' => 'form-control']) }}
</div>

<!-- campos ocultos para poder evitar ingresos null-->
<input type="hidden" name="phone_login" value="{{ $agentes->phone_login }}">
<input type="hidden" name="user_group" value="{{ $agentes->user_group }}">

<!--  fin-->

<div class="form-group">
    {{ form::label('phone_login', 'Extension Actual') }}
    {{ form::text('phone_login', null, ['class' => 'form-control','disabled']) }}
</div>
<div class="form-group">
    {{ form::label('user_group', 'Grupo Actual') }}
    {{ form::text('user_group', null, ['class' => 'form-control','disabled']) }}
</div>

<div class="form-group">

    @if ($visible == 1)
        {{ Form::radio('server_ip', '192.1.168.1.1', true, ['checked' => 'checked']) }} AREA DE VENTAS
        <br />
        {{ Form::radio('server_ip', '192.1.168.1.77', false, []) }} AREA DE COBRANZA
    @else
    {{ Form::radio('server_ip', '192.1.168.1.1', false, []) }} AREA DE VENTAS
        <br />
        {{ Form::radio('server_ip', '192.1.168.1.77', true, ['checked' => 'checked']) }} AREA DE COBRANZA
    @endif

        <!--validar que venga con extension-->
        <br>

        @if ( !isset($telefonia->server_ip))
        <small> <b>sin extension asignada</b></small>
        @else
        <br>
        <small>  <b>server telefonia</b> <i> {{ $telefonia->server_ip }} </i></small>
    @endif


</div>

<div class="form-group">
    {{ form::label('user_group', 'Grupo ') }}
    <select name="user_group2" class="browser-default custom-select" class="form-control{{ $errors->has('user_group') ? ' is-invalid' : ''  }}" autofocus  >
    <option value="">---- Seleccionar un Grupos -----</option>
        @foreach ($grupo as $grupos)

            <option value="{{ $grupos->user_group }}"> {{ $grupos->group_name }}</option>
        @endforeach
        @if ($errors->has('user_group'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('user_group') }}</strong>
            </span>
        @endif
    </select>
</div>

<div class="form-group">
    {{ form::label('phone_login', 'Nueva   Extension ') }}
    <select name="phone_login2" class="browser-default custom-select" class="form-control{{ $errors->has('phone_login') ? ' is-invalid' : ''  }}" autofocus  >
    <option value="">---- Seleccionar un  Extension -----</option>
        @foreach ($phone as $phones)

            <option value="{{ $phones->extension }}">{{ $phones->extension }} {{ $phones->login }}</option>
        @endforeach
        @if ($errors->has('phone_login'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('phone_login') }}</strong>
            </span>
        @endif
    </select>
</div>


<center>
<div class="form-group">
    {{ form::submit('Actualizar', ['class' => 'btn btn-sm btn-primary']) }}

    <a href="javascript:window.history.back();" class="btn btn-success btn-sm">Volver</a>
   
</div>
</center>