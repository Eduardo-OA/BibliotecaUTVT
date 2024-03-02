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
                            <label style="color: green;"><i class="bi bi-pc-display" style="font-size: large;"></i> Disponible</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <label style="color: red;"><i class="bi bi-pc-display" style="font-size: large;"></i> Ocupado</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <label style="color: gray;"><i class="bi bi-pc-display" style="font-size: large;"></i> En mantenimiento</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <label style="color: #17a2b8;"><i class="bi bi-pc-display" style="font-size: large;"></i> Maquina Seleccionada</label>
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
                                        <label for="carreras" style="font-size: medium; color:black;"> Carrera del estudiante:</label>
                                        <select class="form-control" id="carreras" name="carreras">
                                            <option value="">Seleccione...</option>
                                            <option value="T.S.U Mantenimiento, Área industrial">T.S.U Mantenimiento, Área industrial.</option>
                                            <option value="T.S.U Mecatrónica, Área Sistermas Manufactura Flexible.">T.S.U Mecatrónica, Área Sistermas Manufactura Flexible.</option>
                                            <option value="T.S.U Tecnologías de la información, Área Desarrollo de Software Multiplataforma.">T.S.U Tecnologías de la información, Área Desarrollo de Software Multiplataforma.</option>
                                            <option value="T.S.U Tecnologías de la información, Área infraestructura de Redes Digitales.">T.S.U Tecnologías de la información, Área infraestructura de Redes Digitales.</option>
                                            <option value="T.S.U Procesos Industriales, Área Manufactura.">T.S.U Procesos Industriales, Área Manufactura.</option>
                                            <option value="T.S.U Química, Área Tecnología Ambiental.">T.S.U Química, Área Tecnología Ambiental.</option>
                                            <option value="T.S.U Paramédico.">T.S.U Paramédico.</option>
                                            <option value="T.S.U Desarrollo de Negocios, Área Ventas.">T.S.U Desarrollo de Negocios, Área Ventas.</option>
                                            <option value="T.S.U Desarrollo de Negocios, Área Mercadotecnica.">T.S.U Desarrollo de Negocios, Área Mercadotecnica.</option>
                                            <option value="ING. Mantenimiento Industrial.">ING. Mantenimiento Industrial.</option>
                                            <option value="ING. Mecatrónica">ING. Mecatrónica.</option>
                                            <option value="ING. Desarrollo y Gestión de Software.">ING. Desarrollo y Gestión de Software.</option>
                                            <option value="ING. Redes Inteligentes y Ciberseguridad">ING. Redes Inteligentes y Ciberseguridad.</option>
                                            <option value="ING. Sistemas Productivos.">ING. Sistemas Productivos.</option>
                                            <option value="ING. Tecnología Ambiental.">ING. Tecnología Ambiental.</option>
                                            <option value="LIC. Protección Civil y Emergencias.">LIC. Protección Civil y Emergencias.</option>
                                            <option value="LIC. Innovación de Negocios y Mercadotecnica.">LIC. Innovación de Negocios y Mercadotecnica.</option>
                                            <option value="LIC. Enfermería">LIC. Enfermería</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12 pt-2">
                                    <div class="form-group">
                                        <label for="usuarios" style="font-size: medium; color:black;">Seleccione un estudiante</label>
                                    </div>
                                    <select id="usuariosMaquina" name="usuario_id">
                                        <option value="">Seleccionar estudiante</option>
                                        @foreach($usuarios as $usuario)
                                        <option value="{{ $usuario->id }}" {{ $usuario->id == old('usuario_id') ? 'selected' : '' }}>{{ $usuario->matricula .' - '. $usuario->nombre .' '. $usuario->app .' '. $usuario->apm .' - '. $usuario->carrera }}</option>
                                        @endforeach
                                    </select>
                                    @error('usuario_id')
                                    <br>
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                                <div class="col-12 pt-3">
                                    <div class="form-group">
                                        <label for="maquina" style="font-size: medium; color:black;">Maquina a rentar</label>
                                        <fieldset disabled>
                                            <input type="text" class="form-control" id="maquinaVista" name="maquinaVista" placeholder="Seleccione una maquina" value="{{ 'Isla '.old('isla_id') .'- Maquina '.old('maquina_id') }}">
                                        </fieldset>
                                        <input type="text" class="form-control" id="maquinaForm" name="maquina_id" style="display: none;" value="{{ old('maquina_id') }}">
                                        <input type="text" class="form-control" id="islaForm" name="isla_id" style="display: none;" value="{{ old('isla_id') }}">
                                        @error('maquina_id')
                                        <br>
                                        <span class="text-danger pt-2">{{$message}}</span>
                                        @enderror
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
            <form action="{{ route('renta-libros.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body row">
                    <div class="col-12">
                        <div class="form-group">
                            <label for="libros_id">Seleccione el libro a prestar:</label>
                        </div>
                        <select id="libros_id" name="libros_id">
                            <option value="">Seleccione un libro</option>
                            @foreach($librosDisponibles as $libro)
                            <option value="{{ $libro->id }}">{{ $libro->titulo }} - {{ $libro->genero }} - {{ $libro->disponibilidad ? 'Disponible' : 'No disponible' }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-12 pt-3">
                        <div class="form-group">
                            <label for="usuario_id">Seleccione al estudiante:</label>
                        </div>
                        <select id="usuario_id" name="usuario_id">
                            <option value="">Seleccione un usuario</option>
                            @foreach($usuarios as $usuario)
                            <option value="{{ $usuario->id }}">{{ $usuario->matricula }} - {{ $usuario->nombre }} - {{ $usuario->carrera }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-12 pt-3">
                        <div class="form-group">
                            <label for="fecha_pres">Fecha de Prestamo:</label>
                            <input type="date" id="fecha_pres" name="fecha_pres" class="form-control">
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <label for="fecha_devo">Fecha de Devolucion:</label>
                            <input type="date" id="fecha_devo" name="fecha_devo" class="form-control">
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <label for="notas">Anotaciones acerca del libro:</label>
                            <textarea class="form-control" id="notas" name="notas" rows="5" placeholder="Ingrese el estado en el que se encuentra el libro antes del prestamo:"></textarea>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary">Rentar</button>
                </div>
            </form>

        </div>
    </div>

    <!-- Renta de Libros Modal END -->



    <!-- Devolución de Libros Modal START
este  es para devolver cualuier libro q qyuera tipo select (que llegue antes de lo esperado)-->
    {{--
<div class="modal fade" id="modal-devolucion-libros" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"> Devolución de Libros</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="confirmForm" action="{{ route('renta-libros.destroy', ['renta_libro' => $prestamo->id]) }}" method="POST" enctype="multipart/form-data">

    @csrf
    @method('DELETE')
    <div class="modal-body row">
        <div class="col-12">
            <div class="form-group">
                <label for="libros_id">Libro a devolver:</label>
                <select class="form-control" id="libros_id" name="libros_id">
                    <option value="">Seleccione un libro</option>
                    @foreach($librosDevolver as $libro)
                    <option value="{{ $libro->id }}">{{ $libro->titulo }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-12">
            <div class="form-group">
                <label for="fecha_devo">Fecha de devolución:</label>
                <input type="date" id="fecha_devo" name="fecha_devo" class="form-control">
            </div>
        </div>
        <div class="col-12">
            <div class="form-group">
                <label for="notas">Anotaciones sobre la devolución:</label>
                <textarea class="form-control" id="notas" name="notas" rows="5" placeholder="Ingrese cualquier anotación adicional sobre la devolución"></textarea>
            </div>
        </div>

    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-primary">Devolver</button>
    </div>
    </form>

</div>
</div>
</div> --}}

<!-- Devolución de Libros Modal END -->