<!-- Renta de Maquinas modal START -->
<div class="modal fade bd-example-modal-xl" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Rentar Maquina</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body row">
                <div class="col-12 pt-2">
                    <center>
                        <p>Estados de las maquinas</p>
                        <div class="form-check form-check-inline">
                            <label class="form-check-label" style="color: green;"><i class="bi bi-pc-display" style="font-size: large;"></i> Disponible</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <label class="form-check-label" style="color: red;"><i class="bi bi-pc-display" style="font-size: large;"></i> Ocupado</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <label class="form-check-label" style="color: gray;"><i class="bi bi-pc-display" style="font-size: large;"></i> En mantenimiento</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <label class="form-check-label" style="color: #17a2b8;"><i class="bi bi-pc-display" style="font-size: large;"></i> Maquina Seleccionada</label>
                        </div>
                    </center>
                </div>
                <div class="col-12">
                    <center>
                        <p>
                            @foreach ($islas as $isla)
                            <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapseExample{{ $isla -> isla }}" aria-expanded="false" aria-controls="collapseExample">
                                Isla {{ $isla -> isla }}
                            </button>
                            @endforeach
                        </p>
                    </center>
                </div>
                <div class="col-6">
                    @foreach ( $islas as $isla )
                    <div class="collapse" id="collapseExample{{ $isla -> isla }}">
                        <div class="card card-body">
                            <div class="row justify-content-center">
                                @foreach( $maquinas as $maquina )
                                @if( $maquina->isla == $isla->isla )
                                @if( $maquina->estatus == 'O' || $maquina->estatus == 'M')
                                <fieldset disabled>
                                    <div class="col-3">
                                        <button class="boton-maquina"><i class="bi bi-pc-display" style="font-size: 4rem; @if( $maquina->estatus == 'M' ) color: gray; @elseif( $maquina->estatus == 'O' ) color:red; @endif"></i></button>
                                    </div>
                                </fieldset>
                                @else
                                <div class="col-3">
                                    <button class="boton-maquina" onclick="valoresRenta({{ $isla->isla }},{{ $maquina->id }}), seleccionada(this)"><i class="bi bi-pc-display maquina-icon @if( $maquina->estatus == 'D' ) maquina-disponible @endif" style="font-size: 4rem;"></i></button>
                                </div>
                                @endif
                                @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                <div class="col-6">
                    <div class="card card-body">
                        <form action="{{ route('rentarmaquina') }}" method="POST" enctype="multipart/form-data">
                            {{ csrf_field()}}
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="usuarios" style="font-size: medium; color:black;">Seleccione un estudiante</label>
                                        <select class="form-control" id="usuarios" name="usuario_id">
                                            @foreach($usuarios as $usuario)
                                            <option value="{{ $usuario->id }}">{{ $usuario->matricula .' - '. $usuario->nombre .' '. $usuario->app .' '. $usuario->apm .' - '. $usuario->carrera }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="maquina" style="font-size: medium; color:black;">Maquina a rentar</label>
                                        <fieldset disabled>
                                            <input type="text" class="form-control" id="maquinaVista" name="maquinaVista" placeholder="Seleccione una maquina">
                                        </fieldset>
                                        <input type="text" class="form-control" id="maquinaForm" name="maquina_id" style="display: none;">
                                    </div>
                                </div>
                            </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="submit" class="btn btn-primary">Rentar</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Renta de Maquinas modal END -->

<!-- Finalizar Renta START -->
@foreach($rentas as $renta)
<div class="modal fade" id="createModal{{ $renta->id }}" tabindex="-1" role="dialog" aria-labelledby="createModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createModalLabel">¿Desea Terminar el prestamo?</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body row">
                <div class="col-12">
                    Confirme el termino de uso de la maquina.
                </div>
            </div>
            <div class="modal-footer">
                <form action="{{ route('rentaMaquina.update', $renta->id) }}" method="POST" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    {{ method_field('PUT')}}
                    <input type="text" name="maquina_id" value="{{ $renta->maquina_id }}" style="display: none;">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-success">Confirmar</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endforeach
<!-- Finalizar Renta END -->

<!-- Renta de Libros Modal START -->

<div class="modal fade" id="modal-libros" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"> Renta de Libros</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="">
                <div class="modal-body row">
                    <div class="col-12">
                        <div class="form-group">
                            <label for="libro">Seleccione el libro a prestar: </label>
                            <select class="form-control" id="libro" name="libro">
                                <option>Libro - Genero - Disponibilidad</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <label for="user">Seleccione al estudiante: </label>
                            <select class="form-control" id="user" name="user">
                                <option>Matricula - Nombre - Carrera</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <label for="anotaciones">Anotaciones acerca del libro: </label>
                            <textarea class="form-control" id="anotaciones" name="anotaciones" rows="5" placeholder="Ingrese el estado en el que se encuentra el libro antes del prestamo:"></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary">Rentar</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Renta de Libros Modal END -->