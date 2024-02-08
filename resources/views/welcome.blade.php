@extends('layout.layout')

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
                <a href="#" type="button" data-toggle="modal" data-target=".bd-example-modal-xl">Nueva Renta</a>
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
@endsection