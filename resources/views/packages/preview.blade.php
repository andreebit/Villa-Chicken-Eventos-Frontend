@extends('layout')

@section('content')

    <ol class="breadcrumb">
        <li><a href="{{ route('home.index') }}">Eventos</a></li>
        <li><a href="{{ route('packages.index') }}">Actualizar Paquetes</a></li>
        <li class="active">Vista rápida de Paquetes</li>
    </ol>


    {!!  Form::open(['route' => 'packages.preview', 'method' => 'get']) !!}

    <div class="panel panel-default">
        <div class="panel-body">
            <div class="form-group">
                {{ Form::label('event_type_id', 'Tipo de evento asociado') }}
                {{ Form::select('event_type_id', $eventTypes, null, ['class' => 'form-control', 'placeholder' => 'Escoja un tipo de evento para el paquete', 'required' => 'required']) }}
            </div>

            <button type="submit" class="btn btn-primary">Mostrar</button>
        </div>
    </div>

    {!!  Form::close() !!}


    @if(count($packages) > 0)
        <button type="submit" class="btn btn-warning" onclick="javascript:window.print();">Imprimir</button>
        <hr>
        @foreach($packages as $package)
            <div class="panel panel-default">
                <div class="panel-body">
                    <h3>{{ $package->name }}</h3>
                    <table class="table table-bordered">
                        <tr>
                            <th>Precio por persona:</th>
                            <td>S/ {{ number_format($package->price, 2) }}</td>
                        </tr>
                        <tr>
                            <th>Cantidad mínima de personas:</th>
                            <td>{{ $package->minimum_pax }}</td>
                        </tr>
                    </table>
                    <h4>Elementos:</h4>
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th>Descripción</th>
                            <th>Categoría</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($package->items as $item)
                            <tr>
                                <td>{{ $item->description }}</td>
                                <td>{{ $item->service_category->name }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @endforeach
    @endif

@stop