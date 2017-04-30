@extends('layout')

@section('content')

    <ol class="breadcrumb">
        <li><a href="{{ route('home.index') }}">Eventos</a></li>
        <li><a href="{{ route('quotations.index') }}">Actualizar Cotizaciones</a></li>
        <li class="active">Listado de Cotizaciones</li>
    </ol>

    <div class="text-right">
        <a href="{{ route('quotations.create') }}" type="button" class="btn btn-success btn-sm">Nueva Cotización</a>
    </div>
    <hr>

    {!!  Form::open(['route' => 'quotations.index', 'method' => 'post', 'id' => 'form_quotation_search']) !!}
    <div class="panel panel-default">
        <div class="panel-body">
            <h4>Buscar</h4>
            <table class="table table-bordered">
                <tr>
                    <td>
                        {{ Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Ingrese la búsqueda que desea realizar', 'maxlength' => 50, 'required' => 'required']) }}
                    </td>
                    <td>
                        <button type="submit" class="btn btn-primary">Buscar</button>
                    </td>
                </tr>
            </table>
        </div>
    </div>
    {!!  Form::close() !!}


    <table class="table table-hover">
        <thead>
        <tr>
            <th>Código</th>
            <th>Nombre</th>
            <th>Fecha</th>
            <th>Hora</th>
            <th>Cliente</th>
            <th>Tipo de Evento</th>
            <th>Acciones</th>
        </tr>
        </thead>
        <tbody>
        @if(count($items))
            @foreach($items as $item)
                <tr>
                    <td>{{ $item->id }}</td>
                    <td>{{ $item->description }}</td>
                    <td>{{ $item->date_event }}</td>
                    <td>{{ $item->time_event }}</td>
                    <td>{{ $item->customer->name }}</td>
                    <td>{{ $item->event_type->name }}</td>
                    <td>
                        <a href="{{ route('quotations.preview', ['id' => $item->id]) }}" type="button" class="btn btn-default btn-sm">Imprimir</a>
                        <a href="{{ route('quotations.edit', ['id' => $item->id]) }}" type="button" class="btn btn-primary btn-sm">Editar</a>
                        <a href="{{ route('quotations.delete', ['id' => $item->id]) }}" type="button" class="btn btn-danger btn-sm delete-alert-box">Borrar</a>
                    </td>
                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="7" class="text-center">No se encontraron registros</td>
            </tr>
        @endif
        </tbody>
    </table>
@stop