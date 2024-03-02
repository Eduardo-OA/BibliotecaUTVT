@extends('layout.layout')

@section('content')
{{-- @include('modalesInicio') --}}

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
                <table id="librosTable" class="table">
                    <thead class=" text-primary">
                        <th>Id</th>
                        <th>Título</th>
                        <th>Autor principal</th>
                        <th>Autores</th>
                        <th>Genero</th>
                        <th>Editorial</th>
                        <th>Idioma</th>
                        <th>Cantidad</th>
                        <th>Disponibilidad</th>
                        <th>Ubicación Física</th>
                        <th>Fecha de adquisición</th>
                        <th class="text-center">Acción</th>
                        <th class="text-center">Acción</th>
                    </thead>
                    <tbody>
                        @foreach ($libros as $libro)
                        <tr>
                            <td>{{$libro->id}}</td>
                            <td>{{$libro->titulo}}</td>
                            <td>{{$libro->autor_principal}}</td>
                            <td>{{$libro->autores}}</td>
                            <td>{{$libro->genero}}</td>
                            <td>{{$libro->editorial}}</td>
                            <td>{{$libro->idioma}}</td>
                            <td>{{$libro->cantidad}}</td>
                            <td>{{$libro->disponibilidad}}</td>
                            <td>{{$libro->ubicacion}}</td>
                            <td>{{$libro->fechaadqui}}</td>
                            <td>
                                <!-- Botón para editar registro de libros -->
                                <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#editModal{{$libro->id}}">
                                    Editar
                                </button>
                            </td>
                            <td>
                                <!-- Botón para borrar registro de libros -->
                                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteModal{{$libro->id}}">
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

<!-- Alertas -->
<script>
    $(document).ready(function() {
        @if(session('success'))
        $.notify({
            message: "<b> Proceso exitoso! </b> {{ session('success') }}!"
        }, {
            type: 'success',
            timer: 8000,
            placement: {
                from: 'top',
                align: 'center'
            }
        });
        @endif
        @if(isset($errors) && count($errors) > 0)
        $.notify({
            message: "<b> Algo salió mal! </b> Asegurese que los datos en el formulario sean correctos"
        }, {
            type: 'danger',
            timer: 8000,
            placement: {
                from: 'top',
                align: 'center'
            }
        });
        @endif
    });
</script>
<script>
    $(document).ready(function() {
        $('#librosTable').DataTable({
            language: {
                "decimal": "",
                "emptyTable": "No hay información",
                "info": "Mostrando _START_ - _END_ de _TOTAL_ Entradas",
                "infoEmpty": "Mostrando 0 para 0 de 0 Entradas",
                "infoFiltered": "(Filtrado de _MAX_ total entradas)",
                "infoPostFix": "",
                "thousands": ",",
                "lengthMenu": "Mostrar _MENU_ Entradas",
                "loadingRecords": "Cargando...",
                "processing": "Procesando...",
                "search": "Buscar:",
                "zeroRecords": "Sin resultados encontrados",
            },
        });
    });
</script>
@endsection

@section('modals')
@include('libros.modalesLibros')
@endsection