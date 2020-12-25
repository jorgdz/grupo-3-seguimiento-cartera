@extends('layouts.app')

@section('title', 'Asignaciones de Clientes')
@section('content')
<p>Los siguientes Datos tienen Errores</p>
@if (isset($noexisteIdc))
<table>
    <thead>
        <th>IDC</th>
        <th>ASESOR</th>
    </thead>
    <tbody>
        <tr>
        @foreach ($noexisteIdc as $noexisteIdcs)
            <td>{{ $noexisteIdcs->IDC }}</td>
            <td>{{ $noexisteIdcs->ASESOR }}</td>
        @endforeach
        </tr>
    </tbody>
</table>
@endif

@if (isset($noexisteUser))
<table>
        <thead>
            <th>ASESOR</th>
        </thead>
        <tbody>
            <tr>
            @foreach ($noexisteUser as $noexisteUsers)
                <td>{{ $noexisteUsers->ASESOR }}</td>
            @endforeach
            </tr>
        </tbody>
    </table>
    @endif
@endsection