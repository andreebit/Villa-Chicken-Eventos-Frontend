@extends('layout')

@section('content')

    <ol class="breadcrumb">
        <li><a href="{{ route('home.index') }}">Eventos</a></li>
        <li><a href="{{ route('packages.index') }}">Actualizar Paquetes</a></li>
        <li class="active">Listado de Paquetes</li>
    </ol>

    <div class="text-right">
        <a href="{{ route('packages.create') }}" type="button" class="btn btn-success btn-sm">Nuevo Paquete</a>
    </div>
    <hr>
    <table class="table table-hover">
        <thead>
        <tr>
            <th>Código</th>
            <th>Nombre</th>
            <th>Tipo de Evento</th>
            <th>Acciones</th>
        </tr>
        </thead>
        <tbody>
        @if(count($items))
            @foreach($items as $item)
                <tr>
                    <td>{{ $item->id }}</td>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->event_type }}</td>
                    <td>
                        <a href="{{ route('packages.edit', ['id' => $item->id]) }}" type="button" class="btn btn-primary btn-sm">Editar</a>
                        <a href="{{ route('packages.delete', ['id' => $item->id]) }}" type="button" class="btn btn-danger btn-sm">Borrar</a>
                    </td>
                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="4" class="text-center">No se encontraron registros</td>
            </tr>
        @endif
        </tbody>
    </table>
@stop