@extends('layouts.app')




@section('title', 'Agenda | Ventas')
@section('content')
<div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    
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

                    <h1 class="card-title">Crear nuevo Cliente</h1>
                    <br>                
                </div>
                
                <div class="card-body">
                    {!! Form::open(['route' => 'users.store']) !!}
                    <div class="row">

                        <!-- BLOQUE 1-->
                        <div class="col-lg-4">
                            <div class="form-group">
                                {{ Form::label('cedula', 'Cédula(*)') }}
                                {{ Form::text('cedula', null, ['placeholder'=>'Cédula del cliente', 'class' => 'form-control']) }}
                            </div> 

                            <div class="form-group">
                                    {{ Form::label('direccion', 'Dirección Domicilio') }}
                                    {{ Form::text('direccion', null, ['placeholder'=>'Dirección domiciliaria', 'class' => 'form-control']) }}
                            </div>

                            <div class="form-group">
                                    {{ Form::label('direcciontrabajo', 'Dirección Laboral') }}
                                    {{ Form::text('direcciontrabajo', null, ['placeholder'=>'Dirección domiciliaria', 'class' => 'form-control']) }}
                            </div>

                            <div class="form-group">
                                {{ Form::label('direccion', 'Dirección') }}
                                {{ Form::text('direccion', null, ['placeholder'=>'Dirección domiciliaria', 'class' => 'form-control']) }}
                            </div> 

                            <div class="form-group">
                                {{ Form::label('celular', 'Celular') }}
                                {{ Form::text('celular', null, ['placeholder' => 'Celular del usuario', 'class' => 'form-control']) }}
                            </div> 

                            <div class="form-group ">
                                {{ Form::label('telefono', 'Teléfono del Convencional') }}
                                {{ Form::text('telefono', null, ['placeholder'=>'Teléfono convencional', 'class' => 'form-control']) }}
                                
                            </div>

                        </div>
<!-- FIN BLOQUE 1-->

<!-- BLOQUE 2-->
                        <div class="col-lg-4">
                                <div class="form-group">
                                    {{ Form::label('nombres', 'Nombres(*)') }}
                                    {{ Form::text('nombres', null, ['placeholder'=>'Cédula del cliente', 'class' => 'form-control']) }}
                                </div> 
    
                                <div class="form-group">
                                    {{ Form::label('ciudad', 'Ciudad Domicilio') }}
                                    {{ Form::text('ciudad', null, ['placeholder'=>'Ciudad', 'class' => 'form-control']) }}
                                </div>
    
                                <div class="form-group">
                                        {{ Form::label('referenciatrabajo', 'Referencias Laboral') }}
                                        {{ Form::text('referenciatrabajo', null, ['placeholder'=>'Referencias Laboral', 'class' => 'form-control']) }}
                                    </div>
    
                                <div class="form-group">
                                    {{ Form::label('direccion', 'Dirección') }}
                                    {{ Form::text('direccion', null, ['placeholder'=>'Dirección domiciliaria', 'class' => 'form-control']) }}
                                </div> 
    
                                <div class="form-group">
                                    {{ Form::label('celular', 'Celular') }}
                                    {{ Form::text('celular', null, ['placeholder' => 'Celular del usuario', 'class' => 'form-control']) }}
                                </div> 
    
                                <div class="form-group ">
                                    {{ Form::label('telefono', 'Teléfono del Convencional') }}
                                    {{ Form::text('telefono', null, ['placeholder'=>'Teléfono convencional', 'class' => 'form-control']) }}
                                    
                                </div>
    
                            </div>
<!-- FIN BLOQUE 2-->

<!-- BLOQUE 3-->
                        <div class="col-lg-2">
                            <div class="form-group">
                                {{ Form::label('genero_id', 'Genero') }}
                                {!! Form::select('genero_id', $generos->pluck('nombre_genero', 'id'), null, ['class' => 'form-control']) !!}
                            </div>

                            <div class="form-group">
                                {{ Form::label('referenciacasa', 'Referencias Domicilio') }}
                                {{ Form::text('referenciacasa', null, ['placeholder'=>'Referencias Domicilio', 'class' => 'form-control']) }}
                            </div>

                            <div class="form-group">
                                    {{ Form::label('referenciaempleo', 'Referencias Empleo') }}
                                    {{ Form::text('referenciaempleo', null, ['placeholder'=>'Referencias Empleo', 'class' => 'form-control']) }}
                                </div>

                            <div class="form-group">
                                <label id="si">{{ Form::radio('discapacidad', '1') }} Posee alguna discapacidad</label> &nbsp; &nbsp; &nbsp;
                                <label id="no">{{ Form::radio('discapacidad', '0', ['checked']) }} No posee ninguna discapacidad</label>
                            </div>
                          

                            <div class="form-group" id="discapacidad">
                                {{ Form::label('comentario', 'Comentar la discapacidad del usuario') }}
                                {{ Form::textarea('comentario', null, ['class' => 'form-control', 'rows' => '3']) }}
                            </div>
                            
                            <div class="form-group">
                                {{ Form::label('extension', 'Extension') }}
                                {{ Form::text('extension', null, ['placeholder' => 'Extension', 'class' => 'form-control']) }}
                            </div> 

                            <div class="form-group">
                                {{ Form::label('enabled', 'Estado') }}
                                {!! Form::select('enabled', ['0' => 'Inactivo', '1'=>'Activo'], null, ['class' => 'form-control']) !!}
                            </div> 

                            <div class="form-group">
                                {{ Form::label('fecha_nacimiento', 'Fecha de nacimiento') }}
                                {{ Form::date('fecha_nacimiento', date('Y-m-d'), ['class' => 'form-control']) }}
                            </div>
                            <div class="form-group">
                                <label >{{ Form::radio('area', '1') }} AREA VENTAS</label> &nbsp; &nbsp; &nbsp;
                                <label >{{ Form::radio('area', '0') }} AREA COBRANZA</label>&nbsp; &nbsp; &nbsp;
                                <label >{{ Form::radio('area', '2') }} ADMINISTRATIVA</label>
                            </div>
                                <div class="form-group">
                                    <label >{{ Form::radio('rol', '1') }} AGENTE</label> &nbsp; &nbsp; &nbsp;
                                    <label >{{ Form::radio('rol', '0') }} OPERATIVO</label>
                                    
                                </div>
                            </div>
                            <div class="col-lg-2">
                                <div class="form-group">
                                    {{ Form::label('estado_civil', 'Estado civil') }}
                                    {!! Form::select('estado_civil', [null => 'Seleccione estado civil'] + ['Soltero' => 'Soltero','Casado'=>'Casado','Viudo'=>'Viudo','Divorciado'=>'Divorciado', 'Unido'=>'Unido'], null, ['class' => 'form-control']) !!}
                                </div>
                                <div class="form-group">
                                    {{ Form::label('domicilio', 'Domicilio') }}
                                    {!! Form::select('domicilio', [null => 'Seleccione estado Domicilio'] + ['Alquilada' => 'alquilada','Propia'=>'propia','familiares'=>'Familiares'], null, ['class' => 'form-control']) !!}
                                </div>

                                <div class="form-group">
                                        {{ Form::label('domicilio', 'Estado Laboral') }}
                                        {!! Form::select('domicilio', [null => 'Seleccione estado Empleo'] + ['temporal' => 'Temporal','fijo'=>'Fijo','contratado'=>'Contratado','desempleado'=>'Desempleado'], null, ['class' => 'form-control']) !!}
                                    </div>
                            </div> 
                    </div> 
                    
<!-- fin BLOQUE 3-->
                    {{ Form::submit('Guardar', ['class' => 'btn btn-sm btn-primary']) }}

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')



@endsection