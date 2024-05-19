<!-- Modal registrar nueva carrera START -->
<div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="createModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createModalLabel">Agregar Carrera</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('carreras.create') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-body row">
                    <div class="col-12">
                        <div class="form-group">
                            <label for="nombre">Nombre de la carrera</label>
                            <input type="text" class="form-control" id="nombre" name="nombre" aria-describedby="textHelp">
                            <small id="textHelp" class="form-text text-muted">Ingrese el nombre de la carrera deseada.</small>
                        </div>
                        @error('nombre')
							<small class="form-text text-danger">{{$message}}</small>
						@enderror
                    </div>
                    <div class="col-12">
                        <label for="nombre">Estatus de la carrera</label>
                        <div class="custom-control custom-radio">
                            <input type="radio" id="activo" name="activo" class="custom-control-input" value=true>
                            <label class="custom-control-label" for="activo">Activo</label>
                        </div>
                        <div class="custom-control custom-radio">
                            <input type="radio" id="inactivo" name="activo" class="custom-control-input" value=false>
                            <label class="custom-control-label" for="inactivo">Inactivo</label>
                        </div>
                        <small id="textHelp" class="form-text text-muted">Las carreras inactivas unicamente apareceran en reportes.</small>
                        @error('activo')
							<small class="form-text text-danger">{{$message}}</small>
						@enderror
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
<!-- Modal registrar nueva carrera END -->

<!-- Modal editar carrera START -->
@foreach ($carreras as $carrera)
<div class="modal fade" id="updateModal{{$carrera->id}}" tabindex="-1" role="dialog" aria-labelledby="updateModal{{$carrera->id}}Label" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="updateModal{{$carrera->id}}Label">Agregar Carrera</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('carreras.update', $carrera->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="modal-body row">
                    <div class="col-12">
                        <div class="form-group">
                            <label for="nombre">Nombre de la carrera</label>
                            <input type="text" class="form-control" id="nombre" name="nombre" aria-describedby="textHelp" value="{{ old('nombre', $carrera->nombre) }}">
                            <small id="textHelp" class="form-text text-muted">Ingrese el nuevo nombre de la carrera deseada.</small>
                        </div>
                        @error('nombre')
							<small class="form-text text-danger">{{$message}}</small>
						@enderror
                    </div>
                    <div class="col-12">
                        <label for="nombre">Estatus de la carrera</label>
                        <div class="custom-control custom-radio">
                            <input type="radio" id="activoUpdate{{ $carrera->id }}" name="activo" class="custom-control-input" value=true {{ $carrera->activo === true ? 'checked' : '' }}>
                            <label class="custom-control-label" for="activoUpdate{{ $carrera->id }}">Activo</label>
                        </div>
                        <div class="custom-control custom-radio">
                            <input type="radio" id="inactivoUpdate{{ $carrera->id }}" name="activo" class="custom-control-input" value=false {{ $carrera->activo === false ? 'checked' : '' }}>
                            <label class="custom-control-label" for="inactivoUpdate{{ $carrera->id }}">Inactivo</label>
                        </div>
                        <small id="textHelp" class="form-text text-muted">Las carreras inactivas unicamente apareceran en reportes.</small>
                        @error('activo')
							<small class="form-text text-danger">{{$message}}</small>
						@enderror
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
@endforeach
<!-- Modal editar carrera END -->

<!-- Modal eliminar carrera START -->
@foreach ($carreras as $carrera)
<div class="modal fade" id="deleteModal{{$carrera->id}}" tabindex="-1" role="dialog" aria-labelledby="deleteModal{{$carrera->id}}Label" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModal{{$carrera->id}}Label">Eliminar Carrera</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body row text-center">
                <div class="col-12">
                    <h6>¿Realmente desea eliminar la carrera <strong>{{ $carrera->nombre }}</strong>?</h6>
                </div>
            </div>
            <form action="{{ route('carreras.destroy', $carrera->id) }}" method="post">
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
<!-- Modal eliminar carrera END -->