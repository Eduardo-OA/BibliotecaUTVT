@extends('layout.layout')

@section('content')
<div class="col-md-12">
    <div class="card">
        <div class="card-header row">
            <div class="col">
                <h4 class="card-title px-4"> Carreras</h4>
                <p class="card-category px-4"> Tabla de carreras regitradas en la universidad.</p>
            </div>
            <div class="col p-4 d-flex justify-content-end">
                <!-- Button añadir carrera modal -->
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#createModal">
                    Añadir
                </button>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table">
                    <thead class="text-primary">
                        <th class="text-center">Id</th>
                        <th class="text-center">Nombre de la carrera</th>
                        <th class="text-center">Estatus</th>
                        <th colspan="2" class="text-center">Acciones</th>
                    </thead>
                    <tbody>
                        @foreach ($carreras as $carrera)
                        <tr>
                            <td class="text-center">{{$carrera->id}}</td>
                            <td>{{$carrera->nombre}}</td>
                            <td class="@if( $carrera->activo == true ) text-success @elseif( $carrera->activo == False ) text-secondary @endif">
                                <strong>
                                    @if( $carrera->activo == true )
                                    Activa
                                    @elseif( $carrera->activo == false )
                                    Inactivo
                                    @endif
                                </strong>
                            </td>
                            <td class="text-center">
                                <!-- Botón para editar registro de carreras -->
                                <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#updateModal{{$carrera->id}}">
                                    Editar
                                </button>
                                <!-- Botón para borrar registro de carreras -->
                                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteModal{{$carrera->id}}">
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
    var navbar = document.querySelector('#usuarios');
    navbar.className = "active";

    // Titulo de la paginá
    var titulo = document.querySelector('#titulo');
    titulo.innerHTML = 'carreras';
</script>

<!-- Alertas -->
<script>
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
    @if(session('error'))
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
</script>
@endsection

@section('modals')
@include('carreras.modales')
@endsection