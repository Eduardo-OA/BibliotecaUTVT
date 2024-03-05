@extends('layout.layout')
@section('css')
<link rel="stylesheet" href="{{ asset('css/islas.css') }}">
<link rel="stylesheet" href="{{ asset('css/virtual-select.min.css') }}">
<link rel="stylesheet" href="{{ asset('css/tooltip.min.css') }}">
@endsection

<!-- Contenido de la página START -->
@section('content')
<div class="col-lg-3 col-md-6 col-sm-6">
    <div class="card card-stats">
        <div class="card-body ">
            <div class="row">
                <div class="col-5 col-md-4">
                    <div class="icon-big text-center icon-warning">
                        <i class="bi bi-pc-display-horizontal text-danger"></i>
                    </div>
                </div>
                <div class="col-7 col-md-8">
                    <div class="numbers">
                        <p class="card-category">Prestamo de maquinas</p>
                        <p class="card-title">{{ $cantidadMaquinasRenta }}
                        <p>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer ">
            <hr>
            <div class="stats">
                <i class="bi bi-check"></i>
                <!-- Extra large modal -->
                <a href="#" type="button" data-toggle="modal" data-target=".bd-example-modal-xl">Nuevo Prestamo</a>
            </div>
        </div>
    </div>
</div>
<div class="col-lg-3 col-md-6 col-sm-6">
    <div class="card card-stats">
        <div class="card-body ">
            <div class="row">
                <div class="col-5 col-md-4">
                    <div class="icon-big text-center icon-warning">
                        <i class="bi bi-book-half text-primary"></i>
                    </div>
                </div>
                <div class="col-7 col-md-8">
                    <div class="numbers">
                        <p class="card-category">Prestamo de libros</p>
                        <p class="card-title">{{ $cantidadLibrosRenta }}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer ">
            <hr>
            <div class="stats">
                <i class="bi bi-check"></i>
                <!-- Extra large modal -->
                <a href="#" type="button" data-toggle="modal" data-target="#modal-libros">Nuevo Prestamo</a>
            </div>
        </div>
    </div>
</div>
<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title"> Maquinas en prestamo</h4>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table">
                    <thead class=" text-danger text-center">
                        <th>
                            Nombre del estudiante
                        </th>
                        <th>
                            Maquina - Isla
                        </th>
                        <th>
                            Hora de inicio
                        </th>
                        <th>
                            Hora Final
                        </th>
                        <th class="text-center">
                            Acciones
                        </th>
                    </thead>
                    <tbody class="text-center">
                        @foreach($rentaTable as $renta)
                        <tr>
                            <td>
                                {{ $renta->matricula.' - '.$renta->nombre .' '. $renta->app .' '. $renta->apm }}
                            </td>
                            <td>
                                {{ 'Isla '.$renta->isla.' - Maquina '.$renta -> maquina_id }}
                            </td>
                            <td class="text-center">
                                {{ $renta -> hora_inicio }}
                            </td>
                            @if( $renta->hora_final !== NULL )
                            <td>
                                {{ $renta->hora_final }}
                            </td>
                            <td class="text-danger">
                                Renta Finalizada
                            </td>
                            @else
                            <td class="text-center">
                                <div class="reloj">
                                    <span class="hora"></span>:<span class="minutos"></span>:<span class="segundos"></span>
                                </div>
                            </td>
                            <td class="text-center">
                                <button class="btn btn-secondary" data-toggle="modal" data-target="#createModal{{ $renta->id }}">Finalizar prestamo</button>
                            </td>
                            @endif
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title"> Libros en prestamo</h4>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table">
                    <thead class=" text-primary">
                        <th>
                            Nombre del estudiante
                        </th>
                        <th>
                            Libro prestado
                        </th>
                        <th>
                            Fecha inicio del prestamo
                        </th>
                        <th class="text-center">
                            Acciones
                        </th>
                    </thead>
                    <tbody>
                        @foreach ($librosAlquilados as $prestamo)
                        <tr>
                            <td> {{ $prestamo->user->nombre }} {{ $prestamo->user->app }} {{ $prestamo->user->apm }}
                            </td>
                            <td>{{ $prestamo->libro->titulo }}</td>
                            <td class="text-center">
                                {{ \Carbon\Carbon::createFromFormat('Y-m-d', $prestamo->fecha_pres)->format('d - F - Y') }}
                            </td>

                            {{-- <td class="text-center">{{ $prestamo->fecha_pres->format('d - F - Y') }}</td> --}}


                            <!-- Finalizar renta   INICIO -->

                            <td class="text-center">
                                <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#modal-devolucion-libros{{ $prestamo->id }}">
                                    Devolver
                                </button>
                            </td>

                            <!-- Devolución de Libros Modal START -->
                            <div class="modal fade" id="modal-devolucion-libros{{ $prestamo->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel"> Devolución de Libros</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form action="{{ route('renta-libros.destroy', ['renta_libro' => $prestamo->id]) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <div class="modal-body row">
                                                <div class="col-12">
                                                    <p class="text-center" style="font-size: 18px;">¿Estás seguro de
                                                        finalizar el prestamo del libro? <br>
                                                    </p>
                                                </div>
                                                <div class="col-12 text-center">
                                                    <b>{{ $prestamo->libro->titulo }}</b> alquilado por: <b><i> {{ $prestamo->user->nombre .' '. $prestamo->user->app .' '. $prestamo->user->apm }}</i></b>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal" style="font-size: 16px;">Cancelar</button>
                                                <button type="submit" class="btn btn-success" style="font-size: 16px;">Confirmar</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <!-- Devolución de Libros Modal END -->
                            @endforeach
                            <!-- Devolución de Libros Modal END -->

                            </td>
                            <!-- Finalizar renta   END -->
                        </tr>

                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
<!-- Contenido de la página END -->

@section('js')
<script>
    // Selector de la sección en el navbar
    var navbar = document.querySelector('#inicio');
    navbar.className = "active";

    // Titulo de la paginá
    var titulo = document.querySelector('#titulo');
    titulo.innerHTML = 'Inicio';
</script>

<script>
    //  Funcion para colorear una maquina que fue selecciona
    function seleccionada(selected) {
        const allMachines = document.querySelectorAll('.maquina-icon');

        allMachines.forEach(e => {
            if (e.classList.contains('maquina-seleccionada')) {
                e.classList.remove('maquina-seleccionada');
                e.classList.add('maquina-disponible');
            }
        });

        let maquinaSelected = selected.lastElementChild;
        maquinaSelected.classList.remove('maquina-disponible');
        maquinaSelected.classList.add('maquina-seleccionada');
    }

    //  Funcion para mostrar que isla y que maquina fueron seleccionadas así como el envio de controlador del valor de la mquina 
    function valoresRenta(isla, maquina) {
        const inputMaquinaVista = document.querySelector('#maquinaVista');
        const inputMaquinaForm = document.querySelector('#maquinaForm');
        const islaForm = document.querySelector('#islaForm');
        inputMaquinaForm.value = maquina;
        islaForm.value = isla;
        inputMaquinaVista.value = `Isla ${isla} - Maquina ${maquina}`;
    }
</script>

<script>
    //  Mostrar hora final en tiempo real
    function actualizarReloj() {
        const relojElemento = document.querySelectorAll('.reloj');
        const horaElemento = document.querySelectorAll('.hora');
        const minutosElemento = document.querySelectorAll('.minutos');
        const segundosElemento = document.querySelectorAll('.segundos');

        const ahora = new Date();
        const hora = ahora.getHours();
        const minutos = ahora.getMinutes();
        const segundos = ahora.getSeconds();

        relojElemento.forEach((e, i) => { //  e = elemento | i = index
            horaElemento[i].textContent = hora < 10 ? '0' + hora : hora;
            minutosElemento[i].textContent = minutos < 10 ? '0' + minutos : minutos;
            segundosElemento[i].textContent = segundos < 10 ? '0' + segundos : segundos;
        });
    }
    setInterval(actualizarReloj, 1000);
</script>
<!-- Alertas -->
<script>
    $(document).ready(function() {
        @if(session('success'))
        $.notify({
            message: "<b> Proceso exitoso! </b> {{ session('success') }}!"
        }, {
            type: 'success',
            timer: 5000,
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
            timer: 5000,
            placement: {
                from: 'top',
                align: 'center'
            }
        });
        @endif
        @if($librosDevolver -> isNotEmpty())
        $.notify({
            message: "<b> Próximas devoluciones: </b> <ul> @foreach ($librosDevolver as $libro) <li> {{ $libro->libro->titulo }} - Devolver el {{ Carbon\Carbon::parse($libro->fecha_devo)->toDateString() }} </li> @endforeach </ul>"
        }, {
            type: 'warning',
            timer: 5000,
            placement: {
                from: 'top',
                align: 'center'
            }
        });
        @endif
    });
</script>
<script>
    function valoresRenta(isla, maquina) {
        const inputMaquinaVista = document.querySelector('#maquinaVista');
        const inputMaquinaForm = document.querySelector('#maquinaForm');
        inputMaquinaForm.value = maquina;
        inputMaquinaVista.value = `Isla ${isla} - Maquina ${maquina}`;
    }
</script>

<script>
    //  Mostrar hora final en tiempo real
    function actualizarReloj() {
        const relojElemento = document.getElementById('reloj');
        const horaElemento = document.getElementById('hora');
        const minutosElemento = document.getElementById('minutos');

        if (horaElemento) {
            const ahora = new Date();
            const hora = ahora.getHours();
            const minutos = ahora.getMinutes();

            horaElemento.textContent = hora < 10 ? '0' + hora : hora;
            minutosElemento.textContent = minutos < 10 ? '0' + minutos : minutos;
        }

        return
    }
    setInterval(actualizarReloj, 1000);
</script>

{{-- MARCAR LA DEVOLUCION A DB  --}}
<script>
    function devolverPrestamo(prestamoId) {
        // Confirmar si el usuario realmente quiere devolver el préstamo
        if (confirm('¿Estás seguro de que quieres marcar este préstamo como devuelto?')) {
            // Enviar una solicitud AJAX al servidor para marcar el préstamo como devuelto
            axios.post('/devolver-prestamo', {
                    prestamo_id: prestamoId
                })
                .then(function(response) {
                    // Recargar la página o actualizar la lista de préstamos después de marcar el préstamo como devuelto
                    location.reload();
                })
                .catch(function(error) {
                    console.error('Error al marcar el préstamo como devuelto:', error);
                });
        }
    }
</script>

<script src="{{ asset('js/plugins/tooltip.min.js') }}"></script>
<script src="{{ asset('js/plugins/virtual-select.min.js') }}"></script>
<script>
    $(document).ready(function(){
        VirtualSelect.init({ 
            ele: '#usuariosMaquina',
            search: true,
            dropboxWidth: '500px',
        });

        VirtualSelect.init({
            ele: '#libros_id',
            search: true,
            dropboxWidth: '500px',
        });

        VirtualSelect.init({
            ele: '#usuario_id',
            search: true,
            dropboxWidth: '500px',
        });
    });
</script>
@endsection

@section('modals')
@include('modalesInicio')
@endsection