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
                <a class="btn btn-success" href="{{route('reportes')}}">
                    Reportes
                </a>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="maquinasTable" class="table">
                    <thead class="text-primary">
                        <th class="text-center">Id</th>
                        <th>Maquina</th>
                        <th class="text-center">Isla</th>
                        <th class="text-center">Alias</th>
                        <th>Estatus</th>
                        <th class="text-center">Acciones</th>
                    </thead>
                    <tbody>
                        @foreach ($maquinas as $maquina)
                        <tr>
                            <td class="text-center">{{$maquina->id}}</td>
                            <td>Maquina {{$maquina->id}}</td>
                            <td class="text-center">{{$maquina->isla}}</td>
                            <td class="text-center">{{$maquina->alias}}</td>
                            @php
                            $detalleUltimoMantenimiento = \App\Models\MantenimientoMaquina::where('maquina_id', $maquina->id)->latest('created_at')->value('detalle');
                            @endphp
                            <td>
                                @if( $maquina->estatus == 'D' )
                                Disponible
                                @elseif( $maquina->estatus == 'M' )
                                Mantenimiento: <br>
                                {{ $detalleUltimoMantenimiento }}
                                @elseif( $maquina->estatus == 'O' )
                                Ocupado
                                @endif
                            </td>
                            <td class="text-center">
                                <!-- Botón para editar registro de maquinas -->
                                <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#updateModal{{$maquina->id}}">
                                    Editar
                                </button>
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
</script>
<script>
    $(document).ready(function() {
        let table = new DataTable('#maquinasTable', {
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
            responsive: true
        });
    });
</script>
@endsection

@section('modals')
@include('maquinas.modalesMaquinas')
@endsection