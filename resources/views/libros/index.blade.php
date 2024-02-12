@extends('layout.layout')

@section('content')
<div class="col-md-12">
    <div class="card">
        <div class="card-header row">
            <div class="col">
                <h4 class="card-title px-4"> Registro Libros</h4>
                <p class="card-category px-4"> Tabla de libros registrados en biblioteca.</p>
            </div>
            <div class="col p-4 d-flex justify-content-end">
                <!-- Botón para añadir libros -->
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                    Añadir
                </button>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table">
                    <thead class=" text-primary">
                        <th>Id</th>
                        <th>Título</th>
                        <th>Autores</th>
                        <th>Genero</th>
                        <th>Editorial</th>
                        <th>Idioma</th>
                        <th>Cantidad</th>
                        <th>Disponibilidad</th>
                        <th>Ubicación Física</th>
                        <th>Fecha de adquisición</th>
                        <th class="text-center" colspan="2">Acciones</th>
                    </thead>
                    <tbody>
                        <tr>
                            @foreach ($libros as $libros)
                                
                            <td>{{$libros->id}}</td>
                            <td>{{$libros->titulo}}</td>
                            <td>{{$libros->autores}}</td>
                            <td>{{$libros->genero}}</td>
                            <td>{{$libros->editorial}}</td>
                            <td>{{$libros->idioma}}</td>
                            <td>{{$libros->cantidad}}</td>
                            <td>{{$libros->disponibilidad}}</td>
                            <td>{{$libros->ubicacion}}</td>
                            <td>{{$libros->fechaadqui}}</td>
                            <td>
                                <!-- Botón para editar registro de libros -->
                                <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#editModal">
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
                        @endforeach
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
    var navbar = document.querySelector('#libros');
    navbar.className = "active";

    // Titulo de la paginá
    var titulo = document.querySelector('#titulo');
    titulo.innerHTML = 'Libros';
</script>
@endsection

@section('modals')
@include('libros.modalesLibros')
@endsection