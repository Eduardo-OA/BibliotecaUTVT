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
            <div class="modal-body">
                ...
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary">Rentar</button>
            </div>
        </div>
    </div>
</div>
<!-- Renta de Maquinas modal END -->

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
                    <form>
                        <div class="form-group row">
                            <label for="isla" class="col-sm-6 col-form-label">Isla a la que pertenece la maquina:</label>
                            <div class="col-sm-6">
                                <input type="number" class="form-control" id="isla" name="isla">
                            </div>
                        </div>
                        <hr>
                        <fieldset class="form-group pt-2">
                            <div class="row">
                                <legend class="col-form-label col-sm-6 pt-3 px-2">Estatus inicial de la maquina:</legend>
                                <div class="col-sm-6">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="gridRadios" id="statusD" value="D" checked>
                                        <label class="form-check-label" for="status">
                                            Disponible
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="gridRadios" id="statusM" value="M">
                                        <label class="form-check-label" for="statusM">
                                            En mantenimiento
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </fieldset>
                        <p>El estatus puede ser cambiado posteriormente en el botón de <strong>editar</strong> o si la maquina es rentada (y su estado inicial es disponible).</p>
                    </form>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary">Crear registro</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal de alta de maquinas END -->


<!-- Modal de actualización de maquinas START -->
<div class="modal fade" id="updateModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Editar Maquina</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group row">
                    <label for="isla" class="col-sm-6 col-form-label">Isla a la que desea cambiar la maquina:</label>
                    <div class="col-sm-6">
                        <input type="number" class="form-control" id="isla" name="isla">
                    </div>
                </div>
                <hr>
                <fieldset class="form-group pt-2">
                    <div class="row">
                        <legend class="col-form-label col-sm-6 pt-3 px-2">Estatus inicial de la maquina:</legend>
                        <div class="col-sm-6">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="gridRadios" id="statusD" value="D" checked>
                                <label class="form-check-label" for="status">
                                    Disponible
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="gridRadios" id="statusM" value="M">
                                <label class="form-check-label" for="statusM">
                                    En mantenimiento
                                </label>
                            </div>
                        </div>
                    </div>
                </fieldset>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-warning">Guardar cambios</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal de actualización de maquinas END -->

<!-- Modal de eliminar maquinas START -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-danger">Eliminar</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal de eliminar maquinas END -->