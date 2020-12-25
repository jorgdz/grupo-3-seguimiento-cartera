@extends('layouts.app')

@section('title', $user->nombre1)
@section('content')

    <div class="row">
        <div class="col-lg-7">
            <div class="card">
                <div class="card-header">
                    <h1 class="card-title"><strong>Usuario:</strong> {{ $user->apellido_paterno }} {{ $user->apellido_materno }} {{ $user->nombre1 }} {{ $user->nombre2 }}</h1>
                	<br>          

                    @if(session('msg'))
                        <div class="alert alert-success alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <h5><i class="icon fas fa-check"></i>Excelente</h5>                                     
                            <ul>                         
                                <li>{{ session("msg") }}</li>                            
                            </ul>
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="alert alert-danger alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <h5><i class="icon fas fa-check"></i>Error</h5>                                     
                            <ul>                         
                                <li>{{ session("error") }}</li>                            
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
                    <div class="form-group">
                        {{ Form::label('cedula', 'Cédula: ') }} {{$user->cedula}}
                    </div>
                    <div class="form-group">
                        {{ Form::label('nombres', 'Nombres: ') }} {{$user->nombre1}} {{$user->apellido_paterno}}
                    </div>

                    <div class="form-group">
                        {{ Form::label('usuario', 'Nombre de usuario: ') }} {{$user->usuario}}
                    </div>   

                {!! Form::model($user, ['route' => ['users.assign', $user->id], 'method' => 'PUT']) !!}
                    <div class="form-group">
                        {{ Form::label('empresa_id', 'Seleccione una empresa') }}
                        <select name="empresa_id" id="empresa_id" class="form-control" onchange="getdepartamentos(this.value)">
                                <option value="0">Seleccione una empresa</option>
                            @foreach($empresas as $empresa)
                                <option value="{{ $empresa->id }}">{{ $empresa->nombre_empresa }}</option>    
                            @endforeach()
                        </select>
                    </div>   

                    <div class="form-group">
                
                        {{ Form::label('departamento', 'Departamento') }}
                        {!! Form::select('departamento', $departamento->pluck('nombre_departamento', 'id'), null, ['class' => 'form-control']) !!}
                    </div>   

                    <div class="form-group">
                        {{ Form::label('cargo', 'Cargos') }}
                        {!! Form::select('cargo', $cargos->pluck('nombre_cargo', 'id'), null, ['class' => 'form-control']) !!}
                    </div>             
                    <div class="card-footer">
                        {{ Form::submit('Enviar', ['class' => 'btn btn-sm btn-primary']) }}
                    </div>
                </div>

                {!! Form::close() !!}

            </div>
        </div>
    </div>

@endsection

@section('script-discapacidad')

    {{ Html::script('assets/js/send.js') }}

@endsection
