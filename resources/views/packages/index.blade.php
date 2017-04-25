@extends('layout')

@section('content')

    <ol class="breadcrumb">
        <li><a href="#">Eventos</a></li>
        <li><a href="#">Actualizar Paquetes</a></li>
        <li class="active">Listado de Paquetes</li>
    </ol>

    <div class="text-right">
        <button type="button" class="btn btn-success btn-sm">Nuevo Paquete</button>
    </div>
    <hr>
    <table class="table table-hover">
        <thead>
        <tr>
            <th>Código</th>
            <th>Descripción</th>
            <th>Creado por</th>
            <th>Acciones</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td>R0001</td>
            <td>Esto es un mensaje de prueba</td>
            <td>Villa Chicken</td>
            <td>
                <button type="button" class="btn btn-primary btn-sm">Editar</button>
                <button type="button" class="btn btn-danger btn-sm">Borrar</button>
            </td>
        </tr>
        <tr>
            <td>R0001</td>
            <td>Esto es un mensaje de prueba</td>
            <td>Villa Chicken</td>
            <td>
                <button type="button" class="btn btn-primary btn-sm">Editar</button>
                <button type="button" class="btn btn-danger btn-sm">Borrar</button>
            </td>
        </tr>
        <tr>
            <td>R0001</td>
            <td>Esto es un mensaje de prueba</td>
            <td>Villa Chicken</td>
            <td>
                <button type="button" class="btn btn-primary btn-sm">Editar</button>
                <button type="button" class="btn btn-danger btn-sm">Borrar</button>
            </td>
        </tr>
        <tr>
            <td>R0001</td>
            <td>Esto es un mensaje de prueba</td>
            <td>Villa Chicken</td>
            <td>
                <button type="button" class="btn btn-primary btn-sm">Editar</button>
                <button type="button" class="btn btn-danger btn-sm">Borrar</button>
            </td>
        </tr>
        </tbody>
    </table>

    <nav aria-label="Page navigation">
        <ul class="pagination">
            <li>
                <a href="#" aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                </a>
            </li>
            <li><a href="#">1</a></li>
            <li><a href="#">2</a></li>
            <li><a href="#">3</a></li>
            <li><a href="#">4</a></li>
            <li><a href="#">5</a></li>
            <li>
                <a href="#" aria-label="Next">
                    <span aria-hidden="true">&raquo;</span>
                </a>
            </li>
        </ul>
    </nav>
@stop