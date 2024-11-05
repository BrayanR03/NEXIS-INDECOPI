<div id="modalEditarTipoUsuario" class="modalArea modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #006B2D;">
                <h5 class="modal-title" id="exampleModalLabel">Editar Tipo Usuario</h5>
            </div>
            <form class="formTipoUsuario" id="editarTipoUsuarioForm" action="" method="post">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="descripcionArea" class="form-label">Descripción (*):</label>
                        <input type="text" class="descripcionTipoUsuario" id="descripcionTipoUsuario" autocomplete="off">
                    </div>
                    <div>
                        <label for="">Estado</label>
                        <select name="estadoTipoUsuario" id="estadoTipoUsuario">
                            <option value="Activo">Activo</option>
                            <option value="Inactivo">Inactivo</option>
                        </select>
                    </div>
                    <input type="hidden" name="idTipoUsuario" id="idTipoUsuario">
                    <p>Todos los campos (*) son obligatorios</p>
                </div>
                <div class="containerButtonsEditarArea">
                    <input style="background-color: #006B2D;" type="submit" class="btn" value="Actualizar">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                </div>
            </form>
        </div>
    </div>
</div>