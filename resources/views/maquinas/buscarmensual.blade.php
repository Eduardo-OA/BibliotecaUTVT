@extends('layout.layout')

@section('content')
<div class="col-md-12">
    <div class="card">
        <div class="card-header row mt-3">
            <div class="col">
                <h4 class="card-title px-4"> Graficas | Reportes Maquinas</h4>
                <p class="card-category px-4"> Reportes en el sistema de las computadoras.</p>
            </div>
            <div class="col p-4 d-flex justify-content-end">
                <!-- Button añadir maquina modal -->
                <a class="btn btn-info" href="/reportes">
                    Regresar
                </a>
            </div>
        </div>
        <div class="card-body">
            <div class="card-body">
                <div class="container">
                    <div id="my-div">
                        <button onclick="mostrarContenido('contenido1')" class="btn btn-success">Prestamos Computadoras Mesual.</button>     
                        <button onclick="location.reload()" class="btn btn-success">Cerrar</button>
                    </div>



                    <div id="contenido1" style="display:none;">
                        <!-- Aquí va el contenido 1 -->
                        <canvas id="GraficoMensual"></canvas>

                        <form action="{{route('buscarmensual')}}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-12" id="">
                                    <h4>Prestamo por fecha</h4>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="fecha_inicial"><strong style="color: red;">*</strong> Fecha inicial:</label>
                                        <input type="date" max="2024-12-31" class="form-control" id="fecha_inicial" name="fecha_inicial" aria-describedby="dateStart">
                                        <small id="dateStart" class="form-text text-muted">Ingrese la fecha de inicio de los reportes.</small>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="fecha_final"><strong style="color: red;">*</strong> Fecha final:</label>
                                        <input type="date" class="form-control" id="fecha_final" name="fecha_final" aria-describedby="dateEnd">
                                        <small id="dateEnd" class="form-text text-muted">Ingrese la fecha de termino de los reportes.</small>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-success">Buscar</button>
                        </form>

                        <div id="my-cerrar">
                        </div>
                    </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script>
    function mostrarContenido(id) {
        // Ocultar todos los contenidos
        document.getElementById('contenido1').style.display = 'none';

        // Mostrar el contenido correspondiente al botón presionado
        document.getElementById(id).style.display = 'block';
    }
</script>

<script>
    // Obtener el elemento de entrada de fecha
    var inputFecha = document.getElementById('fecha_final');

    // Obtener la fecha actual y formatearla como YYYY-MM-DD
    var fechaActual = new Date().toISOString().split('T')[0];

    // Establecer la fecha actual como el valor máximo
    inputFecha.setAttribute('max', fechaActual);
</script>

<!-- -------------------------------Prestamos mesual de computadoras----------------------------------------- -->
<script>
    const bgrEColor = {
        id: 'bgRETColor',
        beforeDraw: (chart, options) => {
            const {
                ctx,
                width,
                height
            } = chart;
            ctx.fillStyle = 'white';
            ctx.fillRect(0, 0, width, height)
            ctx.restore();
        }
    }
    new Chart(document.getElementById("GraficoMensual"), {
        type: 'bar',
        data: {
            labels: [

                @foreach($resultado as $am)
                "{{ $am -> mes_renta }}",

                @endforeach
            ],


            datasets: [{
                label: "Registros de prestamos mensual",
                backgroundColor: [
                    @foreach($resultado as $am)
                    "#" + Math.floor(Math.random() * 16777215).toString(16),
                    @endforeach
                ],

                data: [
                    @foreach($resultado as $am)
                    "{{ $am -> total_rentas }}",

                    @endforeach
                ],
                tension: 0.1,
                fill: false

            }]
        },
        options: {

            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            },
            legend: {
                display: true
            },

        },
        plugins: [bgrEColor],

    });
</script>



<script>
    // Selector de la sección en el navbar
    var navbar = document.querySelector('#maquinas');
    navbar.className = "active";

    // Titulo de la paginá
    var titulo = document.querySelector('#titulo');
    titulo.innerHTML = 'Maquinas | Gráficas';
</script>
@endsection