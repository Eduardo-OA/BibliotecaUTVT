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
                        @foreach ($maquinas as $maquina)
                        <tr class="text-center">
                            <td>{{$maquina->id}}</td>
                            <td>Maquina {{$maquina->id}}</td>
                            <td>{{$maquina->isla}}</td>
                            <td>
                                @if( $maquina->estatus == 'D' )
                                Disponible
                                @elseif( $maquina->estatus == 'M' )
                                Mantenimiento
                                @elseif( $maquina->estatus == 'O' )
                                Ocupado
                                @endif
                            </td>
                            <td>
                                <!-- Botón para editar registro de maquinas -->
                                <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#updateModal{{$maquina->id}}">
                                    Editar
                                </button>
                            </td>
                            <td>
                                <!-- Botón para borrar registro de maquinas -->
                                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteModal{{$maquina->id}}">
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