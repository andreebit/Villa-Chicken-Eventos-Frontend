@extends('layout')


@section('content')
    <?php $old = session()->getOldInput(); ?>

    <ol class="breadcrumb">
        <li><a href="{{ route('home.index') }}">Eventos</a></li>
        <li><a href="{{ route('packages.index') }}">Actualizar Paquetes</a></li>
        <li class="active">Formulario de Paquetes</li>
    </ol>

    {!!  Form::model($package, ['route' => 'packages.post-form', 'method' => 'post', 'id' => 'form_package']) !!}

    {{ Form::hidden('id') }}

    <div class="form-group">
        {{ Form::label('event_type_id', 'Tipo de evento asociado') }}
        {{ Form::select('event_type_id', $eventTypes, null, ['class' => 'form-control', 'placeholder' => 'Escoja un tipo de evento para el paquete', 'required' => 'required']) }}
    </div>

    <div class="form-group">
        {{ Form::label('name', 'Nombre') }}
        {{ Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Ingresa el nombre del paquete', 'maxlength' => 100, 'required' => 'required']) }}
    </div>

    <div class="form-group">
        {{ Form::label('minimum_pax', 'Cantidad mínima de personas') }}
        {{ Form::text('minimum_pax', null, ['class' => 'form-control', 'placeholder' => 'Ingresa la cantidad mínima de personas del paquete', 'required' => 'required', 'data-rule-digits' => 'true', 'data-rule-min' => '1']) }}
    </div>

    <div class="form-group">
        {{ Form::label('price', 'Precio por persona (S/)') }}
        {{ Form::text('price', null, ['class' => 'form-control', 'placeholder' => 'Ingresa el precio por persona del paquete', 'required' => 'required', 'data-rule-number' => 'true', 'data-rule-min' => '0']) }}
    </div>

    <div class="panel panel-default">
        <div class="panel-body">
            <h3>Incluye</h3>
            <table class="table table-hover" id="tbl_elements_package">
                <thead>
                <tr>
                    <th>Descripción</th>
                    <th>Categoría</th>
                    <th><a href="#" type="button" class="btn btn-primary btn-sm" id="add_element_package">Agregar</a>
                    </th>
                </tr>
                </thead>
                <tbody>


                @if(empty($old))
                    @if(isset($package->items) && !empty($package->items))
                        @foreach($package->items as $index => $item)
                            <?php
                            $identifier = uniqid();
                            ?>
                            <tr>
                                <td>
                                    {{ Form::text('description[' . $identifier . ']', $item->description, ['class' => 'form-control', 'placeholder' => 'Ingresa la descripción del elemento', 'maxlength' => 100, 'required' => 'required']) }}
                                </td>
                                <td>
                                    {{ Form::select('service_category_id[' . $identifier . ']', $serviceCategories, $item->service_category->id, ['class' => 'form-control', 'placeholder' => 'Escoja una categoría', 'required' => 'required']) }}
                                </td>
                                <td>
                                    @if($index > 0)
                                        <a href="#" type="button"
                                           class="btn btn-danger btn-sm btn-remove-package-element">Quitar</a>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td>
                                {{ Form::text('description[ab12c]', null, ['class' => 'form-control', 'placeholder' => 'Ingresa la descripción del elemento', 'maxlength' => 100, 'required' => 'required']) }}
                            </td>
                            <td>
                                {{ Form::select('service_category_id[ab12c]', $serviceCategories, null, ['class' => 'form-control', 'placeholder' => 'Escoja una categoría', 'required' => 'required']) }}
                            </td>
                            <td></td>
                        </tr>
                    @endif
                @else
                    <?php $count = 0; ?>
                    @foreach($old['description'] as $identifier => $item)
                        <tr>
                            <td>
                                {{ Form::text('description[' . $identifier . ']', $item, ['class' => 'form-control', 'placeholder' => 'Ingresa la descripción del elemento', 'maxlength' => 100, 'required' => 'required']) }}
                            </td>
                            <td>
                                {{ Form::select('service_category_id[' . $identifier . ']', $serviceCategories, $old['service_category_id'][$identifier], ['class' => 'form-control', 'placeholder' => 'Escoja una categoría', 'required' => 'required']) }}
                            </td>
                            <td>
                                @if($count > 0)
                                    <a href="#" type="button"
                                       class="btn btn-danger btn-sm btn-remove-package-element">Quitar</a>
                                @endif
                            </td>
                        </tr>
                        <?php $count++; ?>
                    @endforeach
                @endif


                </tbody>
            </table>
        </div>
    </div>

    <button type="submit" class="btn btn-primary">Guardar</button>
    <a href="{{ route('packages.index') }}" type="button" class="btn btn-default">Cancelar</a>

    {!!  Form::close() !!}


    @include('packages.partials.package-element')
@stop