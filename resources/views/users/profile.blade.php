@extends('layouts.app')

@section('title', $user->nombre1)
@section('content')

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h1 class="card-title"><strong>Perfil:</strong> {{ $user->apellido_paterno }} {{ $user->apellido_materno }} {{ $user->nombre1 }} {{ $user->nombre2 }}</h1>
                    <br>                
                    <strong> user: </strong> {{ $user->usuario }}
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
                                @foreach ($errors->all() as $error)
                                    @if($error == 'validation.ecuador')
                                        <li>La cédula no es válida</li>
                                    @else
                                        <li> {{ $error }} </li>
                                    @endif
                                @endforeach
                            </ul>
                        </div>
                    @endif

                </div>
                <div class="card-body">
                    {!! Form::model($user, ['route' => ['perfil.update', $user->id], 'method' => 'POST', 'files' => true]) !!}
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                {{ Form::label('cedula', 'Cédula(*)') }}
                                {{ Form::text('cedula', null, ['placeholder'=>'Cédula del usuario', 'class' => 'form-control']) }}
                            </div> 

                            <div class="form-group">
                                {{ Form::label('nombre1', 'Primer nombre(*)') }}
                                {{ Form::text('nombre1', null, ['placeholder'=>'Primer nombre', 'class' => 'form-control']) }}
                            </div>

                            <div class="form-group">
                                {{ Form::label('nombre2', 'Segundo nombre(*)') }}
                                {{ Form::text('nombre2', null, ['placeholder'=>'Segundo nombre', 'class' => 'form-control']) }}
                            </div>

                            <div class="form-group">
                                {{ Form::label('apellido_paterno', 'Apellido paterno(*)') }}
                                {{ Form::text('apellido_paterno', null, ['placeholder'=>'Apellido paterno', 'class' => 'form-control']) }}
                            </div> 

                            <div class="form-group">
                                {{ Form::label('apellido_materno', 'Apellido materno(*)') }}
                                {{ Form::text('apellido_materno', null, ['placeholder'=>'Apellido materno', 'class' => 'form-control']) }}
                            </div> 

                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="inputGroupFileAddon01">Subir foto</span>
                                </div>
                                <div class="custom-file">
                                    <input type="file" name="foto" class="custom-file-input" id="inputGroupFile01"
                                      aria-describedby="inputGroupFileAddon01">
                                    <label class="custom-file-label" for="inputGroupFile01">Seleccionar</label>
                                </div>
                            </div>
                            <br> 
                            
                            <div class="form-group">
                                {{ Form::label('direccion', 'Dirección(*)') }}
                                {{ Form::text('direccion', null, ['placeholder'=>'Dirección domiciliaria', 'class' => 'form-control']) }}
                            </div> 

                            <div class="form-group">
                                {{ Form::label('celular', 'Celular(*)') }}
                                {{ Form::text('celular', null, ['placeholder' => 'Celular del usuario', 'class' => 'form-control']) }}
                            </div> 

                            <div class="form-group">
                                {{ Form::label('telefono', 'Teléfono del usuario') }}
                                {{ Form::text('telefono', null, ['placeholder'=>'Teléfono convencional', 'class' => 'form-control']) }}
                            </div>
                            
                            <div class="form-group">
                                {{ Form::label('estado_civil', 'Estado civil(*)') }}
                                {!! Form::select('estado_civil', [null => 'Seleccione estado civil'] + ['Soltero' => 'Soltero','Casado'=>'Casado','Viudo'=>'Viudo','Divorciado'=>'Divorciado', 'Unido'=>'Unido'], null, ['class' => 'form-control']) !!}
                            </div>

                        </div>

                        <div class="col-lg-6">
                            <div class="form-group">
                                {{ Form::label('email', 'Correo del usuario(*)') }}
                                {{ Form::email('email', null, ['placeholder'=>'Correo', 'class' => 'form-control']) }}
                            </div>  

                            <div class="form-group">
                                {{ Form::label('password', 'Contraseña') }}
                                {{ Form::password('password', array('class' => 'form-control','placeholder' => 'Su contraseña')) }}
                            </div> 

                            <div class="form-group">
                                <label id="si">{{ Form::radio('discapacidad', '1') }} Posee alguna discapacidad</label> &nbsp; &nbsp; &nbsp;
                                <label id="no">{{ Form::radio('discapacidad', '0', ['checked']) }} No posee ninguna discapacidad</label>
                            </div>

                            <div class="form-group" id="discapacidad">
                                {{ Form::label('comentario', 'Comente su discapacidad en caso de poseer alguna') }}
                                {{ Form::textarea('comentario', null, ['class' => 'form-control']) }}
                            </div>
                            
                            <div class="form-group">
                                {{ Form::label('extension', 'Extension(*)') }}
                                {{ Form::text('extension', null, ['placeholder' => 'Extension', 'class' => 'form-control']) }}
                            </div> 

                            <div class="form-group">
                                {{ Form::label('fecha_nacimiento', 'Fecha de nacimiento(*)') }}
                                {{ Form::date('fecha_nacimiento', null, ['class' => 'form-control']) }}
                            </div>
                        </div>
                    </div>

                    {{ Form::submit('Enviar', ['class' => 'btn btn-sm btn-primary']) }}

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>

@endsection
