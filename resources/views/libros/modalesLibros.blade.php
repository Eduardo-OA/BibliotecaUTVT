<!-- Modal Registro de Libros START -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Añadir Libro</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('libros.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="titulo">Título:</label>
                                <input type="text" class="form-control" id="titulo" name="titulo"
                                    placeholder="Libro..." value="{{ old('titulo') }}">
                                @error('titulo')
                                    <small class="form-text text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12 pt-2">
                            <div class="form-group">
                                <label for="autores">Autores:</label>
                                <textarea class="form-control" id="autores" name="autores" rows="3" value="{{ old('autores') }}"></textarea>
                                @error('autores')
                                    <small class="form-text text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-6 pt-2 text-center">
                            <div class="form-group">
                                <label for="genero">Genero:</label>
                                <input type="text" class="form-control" id="genero" name="genero"
                                    placeholder="Literario, Historia, Informatico..." value="{{ old('genero') }}">
                                @error('genero')
                                    <small class="form-text text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-6 pt-2 text-center">
                            <div class="form-group">
                                <label for="editorial">Editorial:</label>
                                <input type="text" class="form-control" id="editorial" name="editorial"
                                    placeholder="Editorial..." value="{{ old('editorial') }}">
                                @error('editorial')
                                    <small class="form-text text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12 pt-2">
                            <div class="form-group">
                                <label for="idioma">Idioma:</label>
                                <input type="text" class="form-control" id="idioma" name="idioma"
                                    placeholder="Español, Ingles, Frances..." value="{{ old('idioma') }}">
                                @error('idioma')
                                    <small class="form-text text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-6 pt-2 text-center">
                            <div class="form-group">
                                <label for="cantidad">Cantidad:</label>
                                <input type="number" class="form-control" id="cantidad" name="cantidad"
                                    placeholder="Cantidad de unidades totales" value="{{ old('cantidad') }}">
                                @error('cantidad')
                                    <small class="form-text text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-6 pt-2 text-center">
                            <div class="form-group">
                                <label for="disponibilidad">Disponibilidad:</label>
                                <input type="number" class="form-control" id="disponibilidad" name="disponibilidad"
                                    placeholder="Disponibilidad..." value="{{ old('disponibilidad') }}">
                                @error('disponibilidad')
                                    <small class="form-text text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12 pt-2">
                            <div class="form-group">
                                <label for="ubicacion">Ubicación Física:</label>
                                <input type="text" class="form-control" id="ubicacion" name="ubicacion"
                                    placeholder="A-1" value="{{ old('ubicacion') }}">
                                @error('ubicacion')
                                    <small class="form-text text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12 pt-2">
                            <div class="form-group">
                                <label for="fechaAdqui">Fecha de adquisición:</label>
                                <input type="date" class="form-control" id="fechaadqui" name="fechaadqui"
                                    value="{{ old('fechaadqui') }}">
                                @error('fechaadqui')
                                    <small class="form-text text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Modal Registro de Libros END -->

<!-- Modal editar registro de libros START -->
@foreach ($libros as $libro)
    <div class="modal fade" id="editModal{{ $libro->id }}" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Editar registro de libro</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('libros.update', $libro->id) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="titulo">Título:</label>
                                    <input type="text" class="form-control" id="titulo" name="titulo"
                                        placeholder="Libro..." value="{{ $libro->titulo }}">
                                    @error('titulo')
                                        <small class="form-text text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12 pt-2">
                                <div class="form-group">
                                    <label for="autores">Autores:</label>
                                    <textarea class="form-control" id="autores" name="autores" rows="3">{{ $libro->autores }}</textarea>
                                    @error('autores')
                                        <small class="form-text text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-6 pt-2 text-center">
                                <div class="form-group">
                                    <label for="genero">Género:</label>
                                    <input type="text" class="form-control" id="genero" name="genero"
                                        placeholder="Literario, Historia, Informático..."
                                        value="{{ $libro->genero }}">
                                    @error('genero')
                                        <small class="form-text text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-6 pt-2 text-center">
                                <div class="form-group">
                                    <label for="editorial">Editorial:</label>
                                    <input type="text" class="form-control" id="editorial" name="editorial"
                                        placeholder="Editorial..." value="{{ $libro->editorial }}">
                                    @error('editorial')
                                        <small class="form-text text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12 pt-2">
                                <div class="form-group">
                                    <label for="idioma">Idioma:</label>
                                    <input type="text" class="form-control" id="idioma" name="idioma"
                                        placeholder="Español, Inglés, Francés..." value="{{ $libro->idioma }}">
                                    @error('idioma')
                                        <small class="form-text text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-6 pt-2 text-center">
                                <div class="form-group">
                                    <label for="cantidad">Cantidad:</label>
                                    <input type="number" class="form-control" id="cantidad" name="cantidad"
                                        placeholder="Cantidad de unidades totales" value="{{ $libro->cantidad }}">
                                    @error('cantidad')
                                        <small class="form-text text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-6 pt-2 text-center">
                                <div class="form-group">
                                    <label for="disponibilidad">Disponibilidad:</label>
                                    <input type="number" class="form-control" id="disponibilidad"
                                        name="disponibilidad" placeholder="Disponibilidad..."
                                        value="{{ $libro->disponibilidad }}">
                                    @error('disponibilidad')
                                        <small class="form-text text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12 pt-2">
                                <div class="form-group">
                                    <label for="ubicacion">Ubicación Física:</label>
                                    <input type="text" class="form-control" id="ubicacion" name="ubicacion"
                                        placeholder="A-1" value="{{ $libro->ubicacion }}">
                                    @error('ubicacion')
                                        <small class="form-text text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12 pt-2">
                                <div class="form-group">
                                    <label for="fechaAdqui">Fecha de adquisición:</label>
                                    <input type="date" class="form-control" id="fechaadqui" name="fechaadqui"
                                        value="{{ $libro->fechaadqui }}">
                                    @error('fechaadqui')
                                        <small class="form-text text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary">Guardar cambios</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endforeach
<!-- Modal editar registro de libros END -->

<!-- Modal borrar registro de libros START -->
@foreach ($libros as $libro)
    <div class="modal fade" id="deleteModal{{ $libro->id }}" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Borrar registro de libro</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    ¿Realmente desea eliminar el registro del libro?
                </div>
                <form action="{{ route('libros.destroy', $libro->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-danger">Eliminar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endforeach
<!-- Modal borrar registro de libros END -->
