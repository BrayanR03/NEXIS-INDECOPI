<div id="modalEstadoUsuario" class="modalArea modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #006B2D;">
                <h5 class="modal-title" id="exampleModalLabel">Cambiar Estado del Usuario</h5>
            </div>
            <form class="formUsuario" id="editarEstadoUsuarioForm" action="" method="post">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="descripcionAreaEstado" class="form-label">Nombres:</label>
                        <input readonly type="text" class="nombresUsuario" id="nombresUsuarioEstado" autocomplete="off">
                    </div>
                    <div class="mb-3">
                        <label for="descripcionAreaEstado" class="form-label">Usuario:</label>
                        <input readonly type="text" class="usuarioUsuario" id="usuarioUsuarioEstado" autocomplete="off">
                    </div>
                    <div class="mb-3">
                        <label for="estadoArea" class="form-label">Estado:</label>
                        <select name="estadoUsuarioVista" id="estadoUsuarioVista">
                            <option value="Activo">Activo</option>
                            <option value="Inactivo">Inactivo</option>
                        </select>
                    </div>
                    <input type="hidden" name="idUsuarioEstado" id="idUsuarioEstado">
                    <!-- <p>Todos los campos (*) son obligatorios</p> -->
                </div>
                <div class="containerButtonsEditarArea">
                    <input style="background-color: #006B2D;" type="submit" class="btn" value="Actualizar">
                    <button  type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                </div>
            </form>
        </div>
    </div>
</div>
