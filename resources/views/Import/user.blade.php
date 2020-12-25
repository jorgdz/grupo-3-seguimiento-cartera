@extends('layouts.app')

@section('content')

            {!! Form::open(['route' => 'import-excel.importUsers','enctype' => 'multipart/form-data']) !!}
            {{ csrf_field() }}
            <div class="form-group">
                    {!! Form::file('file', null) !!}
                </div>
        
                <center>
                {{ form::submit('Guardar', ['class' => 'btn btn-sm btn-primary']) }} 
                
                </center>

            {!! Form::close() !!}
        
@endsection
        
    