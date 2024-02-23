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
    @if(session('success'))
<div id="success-message" class="alert alert-success" style="display: none;">
    {{ session('success') }}
</div>
@endif
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
                    <thead class=" text-danger">
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
                    <tbody>
                        <tr>
                            <td>
                                222110811 - Jossue Alejandro Candelas Hernández
                            </td>
                            <td>
                                Isla 1 - Maquina 2
                            </td>
                            <td class="text-center">
                                14:00
                            </td>
                            <td class="text-center">
                                <div class="reloj">
                                    <span id="hora"></span>:<span id="minutos"></span>
                                </div>
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
                        @foreach ($librosRentados as $prestamo)
    <tr>
        <td> {{ $prestamo->user->nombre }} {{ $prestamo->user->app }} {{ $prestamo->user->apm }}</td>
        <td>{{ $prestamo->libro->titulo }}</td>
        <td class="text-center">{{ \Carbon\Carbon::createFromFormat('Y-m-d', $prestamo->fecha_pres)->format('d - F - Y') }}</td>

        {{-- <td class="text-center">{{ $prestamo->fecha_pres->format('d - F - Y') }}</td> --}}


              <!-- Finalizar renta   INICIO -->

    <td class="text-center">
        <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#modal-devolucion-libros" data-id="{{ $prestamo->id }}">
            Devolver
        </button>



<!-- Devolución de Libros Modal START -->

<div class="modal fade" id="modal-devolucion-libros" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                <div class="modal-body">
                    @foreach ($librosRentados as $prestamo)
                    <p class="text-center" style="font-size: 18px;">¿Estás seguro de finalizar la renta del libro: <br>
                        <b>  {{ $prestamo->libro->titulo }}<br></b>
                            alquilado por:<br>
                        <b>  <i> {{ $prestamo->user->nombre }} {{ $prestamo->user->app }} {{ $prestamo->user->apm }}</i>
                       </b>
                    </p>
                    @endforeach
                </div>
                <div class="modal-footer justify-content-center">
                    <button type="button" style="margin-right: 2%" class="btn btn-secondary" data-dismiss="modal" style="font-size: 16px;">Cancelar</button>
                    <button type="submit" class="btn btn-primary" style="font-size: 16px;">Confirmar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Devolución de Libros Modal END -->

    </td>
    <!-- Finalizar renta   END -->
    </tr>
@endforeach

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
    function valoresRenta(isla, maquina) {
        const inputMaquinaVista = document.querySelector('#maquinaVista');
        const inputMaquinaForm = document.querySelector('#maquinaForm');
        inputMaquinaForm.value = maquina;
        inputMaquinaVista.value = `Isla ${isla} - Maquina ${maquina}`;
        console.log(inputMaquinaForm);
    }
</script>

<script>
    //  Mostrar hora final en tiempo real
    function actualizarReloj() {
        const relojElemento = document.getElementById('reloj');
        const horaElemento = document.getElementById('hora');
        const minutosElemento = document.getElementById('minutos');

        const ahora = new Date();
        const hora = ahora.getHours();
        const minutos = ahora.getMinutes();

        horaElemento.textContent = hora < 10 ? '0' + hora : hora;
        minutosElemento.textContent = minutos < 10 ? '0' + minutos : minutos;
    }
    setInterval(actualizarReloj, 1000);


</script>

<script src="{{ asset('js/jquery.min.js') }}"></script>

<script>
    $(document).ready(function(){
        $('#success-message').fadeIn().delay(2000).fadeOut();
    });
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
            .then(function (response) {
                // Recargar la página o actualizar la lista de préstamos después de marcar el préstamo como devuelto
                location.reload();
            })
            .catch(function (error) {
                console.error('Error al marcar el préstamo como devuelto:', error);
            });
        }
    }
</script>

    <script>
        // Mostrar el mensaje emergente al cargar la página
        document.addEventListener('DOMContentLoaded', function() {
            @if($librosDevolver->isNotEmpty())

            Swal.fire({
                icon: 'warning',
                title: 'Próximas devoluciones:',
                html: '<div class="alert alert-warning"><h4>Próximas devoluciones:</h4><ul>@foreach($librosDevolver as $libro)<div>{{ $libro->libro->titulo }} - Devolver el {{ Carbon\Carbon::parse($libro->fecha_devo)->toDateString() }}</div><br>@endforeach</ul></div>',

                timer: 5000, // Duración en milisegundos (en este caso, 5 segundos)
                timerProgressBar: true,
                showConfirmButton: true,
                position: 'top',
                toast: true,
            });
            console.log(html);
            @endif
        });
    </script>

@endsection

@section('modals')
@include('modalesInicio')

@endsection
