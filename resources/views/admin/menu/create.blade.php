@extends("theme.$theme.layout")
@section('miga')
sistema de Menús
@endsection
@section('titulo')
Menus
@endsection


@section('contenido')
<div class="row">
    <div class="col-lg-12">
        @include('includes.form-error')
        @include('includes.mensaje')
        <div class="card">

            <div class="card-header">
                <h3 class="card-title">Crear Menus</h3>
            </div>

            <div class="box-body">
                <div class="col-md-6">
                    <!-- Horizontal Form -->
                    <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title">fomulario de registro</h3>
                        </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                        <form action="{{ route('menu_gurdar') }}" method="POST" id='form-general' class="form-horizontal" autocomplete="off">
                                @csrf
                            <div class="card-body">

                            @include('admin.menu.form')
                                
                            </div>
                    <!-- /.card-body -->
                            <div class="card-footer">
                                    @include('includes.boton-create')
                            </div>
                    <!-- /.card-footer -->
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>       
@endsection

@section('script')

@endsection