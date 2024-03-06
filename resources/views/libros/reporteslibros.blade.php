@extends('layout.layout')

@section('content')
<div class="col-md-12">
    <div class="card">
        <div class="card-header row">
            <div class="col">
                <h4 class="card-title px-4"> Reportes</h4>
                <p class="card-category px-4"> Reportes en el sistema de los libros.</p>
            </div>
            <div class="col p-4 d-flex justify-content-end">
                <!-- Button añadir maquina modal -->
                <button type="button" class="btn btn-info"><a href="/maquinas">
                        Regresar
                    </a></button>

            </div>
        </div>

        <div class="card-body">
            <div class="card-body">
                <h5>Graficas Reportes </h5>
                <div class="container p-1">
                    <div id="my-div">
                        <button onclick="mostrarContenido('contenido1')" class="btn btn-success">Prestamo Semanal.</button>
                        <button onclick="mostrarContenido('contenido2')" class="btn btn-success">Prestamo Mensual.</button>
                        <button onclick="mostrarContenido('contenido3')" class="btn btn-success">Prestamo Cuatrimestral.</button>
                        <button onclick="mostrarContenido('contenido4')" class="btn btn-success">Carrera que mas viene.</button>
                        <button onclick="mostrarContenido('contenido5')" class="btn btn-success">Libro mas solicitado.</button>
                        <button onclick="location.reload()" class="btn btn-success">Cerrar</button>
                    </div>



                    <div id="contenido1" style="display:none;">
                        <!-- Aquí va el contenido 1 -->
                        <canvas id="GraficoSemanal"></canvas>
                        <div id="my-cerrar">
                        </div>
                    </div>
                    <div id="contenido2" style="display:none;">
                        <!-- Aquí va el contenido 1 -->
                        <canvas id="GraficoMensual"></canvas>
                        <div id="my-cerrar">
                        </div>
                    </div>
                    <div id="contenido3" style="display:none;">
                        <!-- Aquí va el contenido 1 -->
                        <canvas id="GraficoCuatrimestral"></canvas>
                        <div id="my-cerrar">
                        </div>
                    </div>
                    <div id="contenido4" style="display:none;">
                        <!-- Aquí va el contenido 1 -->
                        <canvas id="GraficoCarrera"></canvas>
                        <div id="my-cerrar">
                        </div>
                    </div>
                    <div id="contenido5" style="display:none;">
                        <!-- Aquí va el contenido 1 -->
                        <canvas id="Graficolibromaspedido"></canvas>
                        <div id="my-cerrar">
                        </div>
                    </div>



                    <script>
                        function mostrarContenido(id) {
                            // Ocultar todos los contenidos

                            document.getElementById('contenido1').style.display = 'none';
                            document.getElementById('contenido2').style.display = 'none';
                            document.getElementById('contenido3').style.display = 'none';
                            document.getElementById('contenido4').style.display = 'none';
                            document.getElementById('contenido5').style.display = 'none';
                            // Mostrar el contenido correspondiente al botón presionado
                            document.getElementById(id).style.display = 'block';
                        }
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

                            @foreach($semanal as $am)
                                "{{ $am -> dia_renta }}",

                                @endforeach
                        ],
                        
                     
                        datasets: [{
                            label: "Registros de prestamos semanal",
                            backgroundColor: [
                                    @foreach($semanal as $am)
                                    "#" + Math.floor(Math.random() * 16777215).toString(16),
                                    @endforeach
                            ],
                            
                            data: [
                                @foreach($semanal as $am)
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

                            @foreach($mensual as $am)
                                "{{ $am -> dia_renta }}",

                                @endforeach
                        ],
                        
                     
                        datasets: [{
                            label: "Registros de prestamos mensual",
                            backgroundColor: [
                                    @foreach($mensual as $am)
                                    "#" + Math.floor(Math.random() * 16777215).toString(16),
                                    @endforeach
                            ],
                            
                            data: [
                                @foreach($mensual as $am)
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

<!-- -------------------------------Prestamos cuatrimestral de computadoras----------------------------------------- -->
<script>
            const bgRCColor = {
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
    new Chart(document.getElementById("GraficoCuatrimestral"), {
                    type: 'bar',
                    data: {
                        labels: [

                            @foreach($cuatrimestral as $am)
                                "{{ $am -> dia_renta }}",

                                @endforeach
                        ],
                        
                     
                        datasets: [{
                            label: "Registros de prestamos cuatrimestral",
                            backgroundColor: [
                                    @foreach($cuatrimestral as $am)
                                    "#" + Math.floor(Math.random() * 16777215).toString(16),
                                    @endforeach
                            ],
                            
                            data: [
                                @foreach($cuatrimestral as $am)
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
                    plugins: [bgRCColor],
                    
                });

</script>



<!-- -------------------------------Carreras que mas rentan computadoras----------------------------------------- -->
<script>
            const bgRCAColor = {
                    id: 'bgrCAColor',
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
    new Chart(document.getElementById("GraficoCarrera"), {
                    type: 'bar',
                    data: {
                        labels: [

                            @foreach($carreras as $am)
                                "{{ $am -> carrera }}",

                                @endforeach
                        ],
                        
                     
                        datasets: [{
                            label: "Registros de carreras",
                            backgroundColor: [
                                    @foreach($carreras as $am)
                                    "#" + Math.floor(Math.random() * 16777215).toString(16),
                                    @endforeach
                            ],
                            
                            data: [
                                @foreach($carreras as $am)
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
                    plugins: [bgRCAColor],
                    
                });

</script>


<!-- -------------------------------Libro mas solicitado----------------------------------------- -->
<script>
            const bgrLMColor = {
                    id: 'bgrCAColor',
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
    new Chart(document.getElementById("Graficolibromaspedido"), {
                    type: 'bar',
                    data: {
                        labels: [

                            @foreach($solicitado as $am)
                                "{{ $am -> titulo }}",

                                @endforeach
                        ],
                        
                     
                        datasets: [{
                            label: "Registros de carreras",
                            backgroundColor: [
                                    @foreach($solicitado as $am)
                                    "#" + Math.floor(Math.random() * 16777215).toString(16),
                                    @endforeach
                            ],
                            
                            data: [
                                @foreach($solicitado as $am)
                                "{{ $am -> cantidad_solicitudes }}",

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
                    plugins: [bgrLMColor],
                    
                });

</script>

@endsection