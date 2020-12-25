@extends('auth.app')

@section('login')
  <div id="login">
      <img src="{{ asset('logo.jpg') }}" alt="">&nbsp;&nbsp;&nbsp;&nbsp;
  <div class="login-card">

    <div class="card-title">
     
      <h1>DAMPLUS</h1>
    </div>
    
    <div class="content">
      <form method="POST" action="{{ route('login') }}">
        {{ csrf_field() }}

        {!! $errors->first('usuario', '<span class="error" style="color:red;font-weight: bold;">:message</span>') !!}
        <input id="usuario" type="text" value="{{ old('usuario') }}" name="usuario" title="usuario" placeholder="Usuario" required autofocus>

         {!! $errors->first('password', '<span style="color:red">:message</span>') !!}
        <input id="password" type="password" name="password" title="password" placeholder="Contraseña" required>

        <div class="level options">
          <div class="checkbox level-left">
            <span></span>
          </div>
        </div>

        <button type="submit" class="btn btn-primary">Acceder</button>
      </form>
    </div>
  </div>
</div>
@endsection