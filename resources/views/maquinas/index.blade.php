@extends('layout.layout')

@section('content')
<div class="col-md-12">
    <div class="card">
        <div class="card-header row">
            <div class="col">
                <h4 class="card-title px-4"> Maquinas</h4>
                <p class="card-category px-4"> Tabla de maquinas regitradas.</p>
            </div>
            <div class="col p-4 d-flex justify-content-end">
                <!-- Button añadir maquina modal -->
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#createModal">
                    Añadir
                </button>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table">
                    <thead class="text-center text-primary">
                        <th>Id</th>
                        <th>Maquina</th>
                        <th>Isla</th>
                        <th>Status</th>
                        <th colspan="2">Acciones</th>
                    </thead>
                    <tbody>
                        <tr class="text-center">
                            <td>1</td>
                            <td>Maquina 1</td>
                            <td>Isla 2</td>
                            <td>En mantenimiento</td>
                            <td>
                                <!-- Botón para editar registro de libros -->
                                <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#updateModal">
                                    Editar
                                </button>
                            </td>
                            <td>
                                <!-- Botón para borrar registro de libros -->
                                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteModal">
                                    Borrar
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script>
    // Selector de la sección en el navbar
    var navbar = document.querySelector('#maquinas');
    navbar.className = "active";

    // Titulo de la paginá
    var titulo = document.querySelector('#titulo');
    titulo.innerHTML = 'Maquinas';
</script>
@endsection

@section('modals')
@include('maquinas.modalesMaquinas')
@endsection