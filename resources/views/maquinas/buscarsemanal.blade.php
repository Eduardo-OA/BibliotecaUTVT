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
                        <button onclick="mostrarContenido('contenido1')" class="btn btn-success">Prestamos Computadoras.</button>
                        <a href="{{ route('personal.export', ['parametro1' => $parametro1, 'parametro2' => $parametro2]) }}" class="btn btn-success">Excel</a>
                    </div>
                    <div id="contenido1" style="display:none;">
                        <!-- Aquí va el contenido 1 -->
                        <canvas id="GraficoSemanal"></canvas>
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

<!-- -------------------------------Prestamos semanales de computadoras----------------------------------------- -->
<script>
    const bgREColor = {
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
    new Chart(document.getElementById("GraficoSemanal"), {
        type: 'bar',
        data: {
            labels: [

                @foreach($resultados as $am)
                "{{ $am -> dia_renta }}",

                @endforeach
            ],


            datasets: [{
                label: "Registros de prestamos semanales",
                backgroundColor: [
                    @foreach($resultados as $am)
                    "#" + Math.floor(Math.random() * 16777215).toString(16),
                    @endforeach
                ],

                data: [
                    @foreach($resultados as $am)
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
        plugins: [bgREColor],

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