<!-- Modal de alta de maquinas START -->
<div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Añadir Maquina</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body row">
                <div class="col-12">
                    <form action="{{ route('maquinas.store') }}" method="POST">
                        @csrf
                        <div class="form-group row">
                            <label for="alias" class="col-sm-6 col-form-label"><strong style="color: red;">*</strong> Nuevo alias de la maquina:</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" id="alias" name="alias" class="alias" required>
                            </div>
                            @error('alias')
                            <small class="form-text text-danger px-4">{{$message}}</small>
                            @enderror
                        </div>
                        <div class="form-group row">
                            <label for="isla" class="col-sm-6 col-form-label"><strong style="color: red;">*</strong> Isla a la que pertenece la maquina:</label>
                            <div class="col-sm-6">
                                <input type="number" class="form-control" id="isla" name="isla" class="isla" required>
                            </div>
                            @error('isla')
                            <small class="form-text text-danger px-4">{{$message}}</small>
                            @enderror
                        </div>
                        <hr>
                        <fieldset class="form-group pt-2">
                            <div class="row">
                                <legend class="col-form-label col-sm-6 pt-3 px-2"><strong style="color: red;">*</strong> Estatus inicial de la maquina:</legend>
                                <div class="col-sm-6" id="divDetalleAdd">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="estatus" id="statusD" value="D" checked>
                                        <label class="form-check-label" for="statusD">
                                            Disponible
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="estatus" id="statusM" value="M">
                                        <label class="form-check-label" for="statusM">
                                            En mantenimiento
                                        </label>
                                    </div>
                                </div>
                                @error('estatus')
                                <small class="form-text text-danger">{{$message}}</small>
                                @enderror
                            </div>
                        </fieldset>

                        <div id="detalleMantenimiento" class="col-12 DM" style="display: none;">
                            <div class="form-group">
                                <label for="detalle_mantenimiento">Detalle del mantenimiento:</label>
                                <textarea class="form-control" id="detalle_mantenimiento" name="detalle_mantenimiento" rows="3" placeholder="Escriba una descripción acerca de la razón del mantenimiento"></textarea>
                            </div>
                        </div>

                        <p>El estatus puede ser cambiado posteriormente en el botón de <strong>editar</strong> o si la maquina es prestada (y su estado inicial es disponible).</p>
                        <div class="row" id="formAdd_mantenimiento">

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                            <button type="submit" class="btn btn-primary" id="createBtn">Crear registro</button>
                        </div>

                        <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

                        <!-- Agrega el script para desactivar el botón después del primer clic -->
                        <script>
                            $(document).ready(function(){
                                $('form').on('submit', function(){
                                    $('#createBtn').prop('disabled', true);
                                });
                            });
                        </script>
                        <script>
                            document.addEventListener('DOMContentLoaded', function () {
                                // Obtén el grupo de radio buttons por su nombre
                                var radioGroup = document.getElementsByName('estatus');
                        
                                // Agrega un evento change a cada radio button en el grupo
                                radioGroup.forEach(function (radio) {
                                    radio.addEventListener('change', function () {
                                        // Obtén el valor del radio button seleccionado
                                        var selectedValue = document.querySelector('input[name="estatus"]:checked').value;
                        
                                        // Obtén el div con ID "detalleMantenimiento"
                                        var detalleMantenimientoDiv = document.getElementById('detalleMantenimiento');
                        
                                        // Obtén el textarea dentro del div "detalleMantenimiento"
                                        var detalleMantenimientoTextarea = detalleMantenimientoDiv.querySelector('textarea');
                        
                                        // Muestra u oculta el div según el valor del radio button
                                        detalleMantenimientoDiv.style.display = (selectedValue === 'M') ? 'block' : 'none';
                        
                                        // Agrega o quita el atributo 'required' al textarea según la condición
                                        detalleMantenimientoTextarea.required = (selectedValue === 'M');
                                    });
                                });
                            });
                        </script>
                        
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal de alta de maquinas END -->


<!-- Modal de actualización de maquinas START -->
@foreach ($maquinas as $maquina)
<div class="modal fade" id="updateModal{{$maquina->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Editar Maquina</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('maquinas.update', $maquina->id) }}" method="POST">
                @method("PUT")
                @csrf
                <div class="modal-body">
                    <div class="form-group row">
                        <div class="col-sm-6">
                            <label for="isla" class="form-label"><strong style="color: red;">*</strong> Isla a la que desea cambiar la maquina:</label>
                        </div>
                        <div class="col-sm-6">
                            <input type="number" class="form-control" id="isla" name="isla" value="{{ $maquina->isla }}">
                        </div>
                        @error('isla')
                        <small class="form-text text-danger">{{$message}}</small>
                        @enderror
                    </div>
                    <hr>
                    <fieldset class="form-group pt-2">
                        <div class="row">
                            <legend class="col-form-label col-sm-6 pt-3 px-2"><strong style="color: red;">*</strong> Estatus inicial de la maquina:</legend>
                            <div class="col-sm-6" id="divDetalleEdit">
                                <div class="form-check">
                                    <input class="form-check-input estatus" type="radio" name="estatus" id="EditstatusD" value="D" data-maquina-id="{{ $maquina->id }}">
                                    <label class="form-check-label" for="EditstatusD">
                                        Disponible
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input estatus" type="radio" name="estatus" id="EditstatusM" value="M" data-maquina-id="{{ $maquina->id }}">
                                    <label class="form-check-label" for="EditstatusM">
                                        En mantenimiento
                                    </label>
                                </div>
                            </div>
                            @error('estaus')
                            <small class="form-text text-danger">{{$message}}</small>
                            @enderror
                        </div>
                    </fieldset>
                    <div class="row" id="formEdit_mantenimiento">

                    </div>

                    <div id="detalleMantenimiento_{{ $maquina->id }}" class="col-12 DM" style="display: none;">
                        <div class="form-group">
                            <label for="detalle_mantenimiento">Detalle del mantenimiento:</label>
                            <textarea class="form-control" id="detalle_mantenimiento" name="detalle_mantenimiento" rows="3" placeholder="Escriba una descripción acerca de la razón del mantenimiento"></textarea>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-warning">Guardar cambios</button>
                </div>

                <script>
                    document.addEventListener('DOMContentLoaded', function () {
                        // Obtén todos los elementos con clase "estatus" (todos los radio buttons)
                        var radioButtons = document.querySelectorAll('.estatus');
                
                        // Itera sobre cada radio button
                        radioButtons.forEach(function (radio) {
                            // Agrega un evento change a cada radio button
                            radio.addEventListener('change', function () {
                                // Obtiene el valor del radio button seleccionado
                                var selectedValue = this.value;
                
                                // Obtiene el ID único del div "detalleMantenimiento"
                                var detalleMantenimientoId = 'detalleMantenimiento_' + this.dataset.maquinaId;
                
                                // Obtiene el div con el ID correspondiente
                                var detalleMantenimientoDiv = document.getElementById(detalleMantenimientoId);
                
                                // Obtiene el textarea dentro del div "detalleMantenimiento"
                                var detalleMantenimientoTextarea = detalleMantenimientoDiv.querySelector('textarea');
                
                                // Muestra u oculta el div según el valor del radio button
                                detalleMantenimientoDiv.style.display = (selectedValue === 'M') ? 'block' : 'none';
                
                                // Agrega o quita el atributo 'required' al textarea según la condición
                                detalleMantenimientoTextarea.required = (selectedValue === 'M');
                            });
                        });
                    });
                </script>

            </form>
        </div>
    </div>
</div>
@endforeach
<!-- Modal de actualización de maquinas END -->

<!-- Modal de eliminar maquinas START -->
@foreach ($maquinas as $maquina)
<div class="modal fade" id="deleteModal{{$maquina->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Eliminar Maquina</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                ¿Realmente desea eliminar el registro de la maquina?
            </div>
            <div class="modal-footer">
                <form action="{{ route('maquinas.update', $maquina->id) }}" method="POST">
                    @method("DELETE")
                    @csrf
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-danger">Eliminar</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endforeach
<!-- Modal de eliminar maquinas END -->