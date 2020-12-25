@extends("theme.$theme.layout")
@section('miga')
Menus
@endsection
@section('titulo')
Menus
@endsection


@section('contenido')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Menus</h3>
            </div>
            <div class="card-body">
                    <table class="table table-bordered table-hover  table-striped ">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nombres</th>
                                <th>Slug</th>
                                <th>Descriptión</th>
                            </tr>
                        </thead>
                      <tbody>
                          @foreach ($permiso as $permisos)
                              <tr>
                                  <td>{{ $permisos->id }}</td>
                                  <td>{{ $permisos->name }}</td>
                                  <td>{{ $permisos->slug }}</td>
                                  <td>{{ $permisos->description }}</td>
                              </tr>
                          @endforeach
                      </tbody>
                    </table>
                  </div>
                  {!! $permiso->render() !!}
        </div>
    </div>
</div>       
@endsection