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
                                                <button class="boton-maquina"><i class="bi bi-pc-display" style="font-size: 4rem; @if( $maquina->estatus == 'D' ) color: green; @elseif( $maquina->estatus == 'M' ) color: gray; @else color:red; @endif"></i></button>
                                            </div>
                                        </fieldset>
                                        @else
                                        <div class="col-3">
                                            <button class="boton-maquina" onclick="valoresRenta({{ $isla->isla }},{{ $maquina->id }})"><i class="bi bi-pc-display" style="font-size: 4rem; @if( $maquina->estatus == 'D' ) color: green; @elseif( $maquina->estatus == 'M' ) color: gray; @else color:red; @endif"></i></button>
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
                        <div class="row">
                            <div class="col-12">
                                <h3>Formulario de Prestamo</h3>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="usuarios" style="font-size: medium; color:black;">Seleccione un estudiante</label>
                                    <select class="form-control" id="usuarios" name="usuarios">
                                        <option>222110811 - Jossue Alejandro Candelas Hernández - IDGS</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="maquina" style="font-size: medium; color:black;">Maquina a rentar</label>
                                    <fieldset disabled>
                                        <input type="text" class="form-control" id="maquinaVista" name="maquinaVista" placeholder="Seleccione una maquina">
                                        <input type="text" class="form-control" id="maquinaForm" name="maquina" style="display: none;">
                                    </fieldset>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary">Rentar</button>
            </div>
        </div>
    </div>
</div>
<!-- Renta de Maquinas modal END -->