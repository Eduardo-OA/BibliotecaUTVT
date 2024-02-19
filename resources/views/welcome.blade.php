@extends('layout.layout')

@section('css')
<link rel="stylesheet" href="{{ asset('css/islas.css') }}">
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
                        <p class="card-category">Rentas de maquinas</p>
                        <p class="card-title">10
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
                <a href="#" type="button" data-toggle="modal" data-target=".bd-example-modal-xl">Nueva Renta</a>
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
                        <p class="card-category">Rentas de libros</p>
                        <p class="card-title">55
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
                <a href="#" type="button" data-toggle="modal" data-target="#modal-libros">Nueva Renta</a>
            </div>
        </div>
    </div>
</div>
<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title"> Maquinas en renta</h4>
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
                        @foreach($rentas as $renta)
                        <tr>
                            <td>
                                {{ $renta -> usuario_id }}
                            </td>
                            <td>
                                {{ $renta -> maquina_id }}
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
                                <button class="btn btn-secondary" data-toggle="modal" data-target="#createModal{{ $renta->id }}">Terminar renta</button>
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
            <h4 class="card-title"> Libros en renta</h4>
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
                        <tr>
                            <td>
                                222110811 - Jossue Alejandro Candelas Hernández
                            </td>
                            <td>
                                Matemáticas para Ingenieria II
                            </td>
                            <td class="text-center">
                                14 - Febrero - 2024
                            </td>
                            <td class="text-center">
                                <button class="btn btn-secondary">Terminar renta</button>
                            </td>
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
        inputMaquinaForm.value = maquina;
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
@endsection

@section('modals')
@include('modalesInicio')
@endsection