@extends('layout')


@section('content')
    <?php $old = session()->getOldInput(); ?>

    <ol class="breadcrumb">
        <li><a href="{{ route('home.index') }}">Eventos</a></li>
        <li><a href="{{ route('quotations.index') }}">Actualizar Paquetes</a></li>
        <li class="active">Formulario de Paquetes</li>
    </ol>

    {!!  Form::open(['route' => 'quotations.search-customer', 'method' => 'post', 'id' => 'form_quotation_customer']) !!}
    <div class="panel panel-default">
        <div class="panel-body">
            <h3>Cliente</h3>
            <table class="table table-bordered">
                <tr>
                    <th>
                        {{ Form::label('document_type', 'Tipo de documento') }}
                        {{ Form::select('document_type', ['dni' => 'DNI', 'ruc' => 'RUC'], null, ['class' => 'form-control', 'placeholder' => 'Escoja un tipo de documento', 'required' => 'required']) }}
                    </th>
                    <td>
                        {{ Form::label('document_number', 'Número de documento') }}
                        {{ Form::text('document_number', null, ['class' => 'form-control', 'placeholder' => 'Ingresa el número de documento', 'required' => 'required']) }}
                    </td>
                    <td>
                        <br>
                        <button type="submit" class="btn btn-primary">Buscar</button>
                    </td>
                </tr>
                <tr>
                    <td>
                        {{ Form::text('customer_full_name', null, ['class' => 'form-control', 'placeholder' => 'Nombre del cliente', 'readonly' => 'readonly']) }}
                    </td>
                    <td>
                        {{ Form::text('customer_phone_number', null, ['class' => 'form-control', 'placeholder' => 'Teléfono del cliente', 'readonly' => 'readonly']) }}
                    </td>
                    <td>
                        {{ Form::text('customer_email', null, ['class' => 'form-control', 'placeholder' => 'Correo del cliente', 'readonly' => 'readonly']) }}
                    </td>
                </tr>
                <tr>
                    <td>
                        {{ Form::text('customer_contact_full_name', null, ['class' => 'form-control', 'placeholder' => 'Nombre del contacto', 'readonly' => 'readonly']) }}
                    </td>
                    <td>
                        {{ Form::text('customer_contact_phone_number', null, ['class' => 'form-control', 'placeholder' => 'Teléfono del contacto', 'readonly' => 'readonly']) }}
                    </td>
                    <td>
                        {{ Form::text('customer_contact_email', null, ['class' => 'form-control', 'placeholder' => 'Correo del contacto', 'readonly' => 'readonly']) }}
                    </td>
                </tr>
            </table>
        </div>
    </div>
    {!!  Form::close() !!}


    {!!  Form::model($quotation, ['route' => 'quotations.post-form', 'method' => 'post', 'id' => 'form_quotation']) !!}

    {{ Form::hidden('id') }}
    {{ Form::hidden('customer_id') }}


    <div class="form-group">
        {{ Form::label('description', 'Descripción') }}
        {{ Form::text('description', null, ['class' => 'form-control', 'placeholder' => 'Ingresa la descripción del evento', 'required' => 'required']) }}
    </div>

    <div class="form-group">
        {{ Form::label('event_type_id', 'Tipo de evento asociado') }}
        {{ Form::select('event_type_id', $eventTypes, null, ['class' => 'form-control', 'placeholder' => 'Escoja un tipo de evento para el paquete', 'required' => 'required']) }}
    </div>

    <div class="form-group">
        {{ Form::label('date_event', 'Fecha del evento') }}
        {{ Form::text('date_event', null, ['class' => 'form-control', 'placeholder' => 'Selecciona la fecha del evento', 'required' => 'required']) }}
    </div>

    <div class="form-group">
        {{ Form::label('time_event', 'Hora del evento') }}
        {{ Form::text('time_event', null, ['class' => 'form-control', 'placeholder' => 'Selecciona la hora del evento', 'required' => 'required']) }}
    </div>



    <button type="submit" class="btn btn-primary">Guardar</button>
    <a href="{{ route('quotations.index') }}" type="button" class="btn btn-default">Cancelar</a>

    {!!  Form::close() !!}



@stop