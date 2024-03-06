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
                <table id="maquinasTable" class="table">
                    <thead class="text-primary">
                        <th class="text-center">Id</th>
                        <th>Maquina</th>
                        <th class="text-center">Isla</th>
                        <th>Estatus</th>
                        <th class="text-center">Acciones</th>
                    </thead>
                    <tbody>
                        @foreach ($maquinas as $maquina)
                        <tr>
                            <td class="text-center">{{$maquina->id}}</td>
                            <td>Maquina {{$maquina->id}}</td>
                            <td class="text-center">{{$maquina->isla}}</td>
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
        $('#maquinasTable').DataTable({
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

<!--<script>
    $(document).ready(function() {
        const divRadioButtons = document.querySelector('#divDetalleAdd');
        const divRadioButtonsEdit = document.querySelector('#divDetalleEdit');
        const radioEstatusM = divRadioButtons.querySelector('#statusM');
        const radioEstatusD = divRadioButtons.querySelector('#statusD');
        const detalleMantenimientoDiv = document.querySelector('#formAdd_mantenimiento');
        const editDetalleMantenimiento = document.querySelector('#formEdit_mantenimiento');

        //  Cuando se selecciona el radioEstatusM aparece el campo de detalle del mantenimiento
        radioEstatusM.addEventListener('focus', () => {
            limpiarHTML(detalleMantenimientoDiv);
            crearHTML(detalleMantenimientoDiv);
        });

        //  Cuando se selecciona el radioEstatusD desaparece el campo de detalle del mantenimiento
        radioEstatusD.addEventListener('focus', () => {
            limpiarHTML(detalleMantenimientoDiv);
        });

        divRadioButtonsEdit.addEventListener('click', e => {
            if (e.target.id === 'EditstatusM') {
                limpiarHTML(editDetalleMantenimiento);
                crearHTML(editDetalleMantenimiento);
            } else {
                limpiarHTML(editDetalleMantenimiento);
            }
        });

        //  Elimina el textarea del div donde se colocó
        function limpiarHTML(div) {
            while (div.firstChild) {
                div.firstChild.remove();
            }
        }

        //  Genera el textarea de los modales en maquinas
        function crearHTML(divContenedor) {
            const divCol12 = document.createElement('div');
            divCol12.classList.add('col-12');
            const divFormGroup = document.createElement('div');
            divFormGroup.classList.add('form-group');
            const label = document.createElement('label');
            label.setAttribute('for', 'detalle_mantenimiento');
            label.textContent = "Detalle del mantenimiento:";
            const textArea = document.createElement('textarea');
            textArea.classList.add('form-control');
            textArea.setAttribute('id', 'detalle_mantenimiento');
            textArea.setAttribute('name', 'detalle_mantenimiento');
            textArea.setAttribute('rows', '3');
            textArea.setAttribute('placeholder', 'Escriba una descripción acerca de la razón del mantenimiento');
            divFormGroup.appendChild(label);
            divFormGroup.appendChild(textArea);
            divCol12.appendChild(divFormGroup);
            divContenedor.appendChild(divCol12);
        }

    });
</script>-->
@endsection

@section('modals')
@include('maquinas.modalesMaquinas')
@endsection