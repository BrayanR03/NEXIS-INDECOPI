<div id="modalEditarSede" class="modalArea modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #006B2D;">
                <h5 class="modal-title" id="exampleModalLabel">Editar Sede</h5>
            </div>
            <form class="formArea" id="editarSedeForm" action="" method="post">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="descripcionArea" class="form-label">Descripción (*):</label>
                        <input type="text" class="descripcionArea" id="descripcionSede" autocomplete="off">
                    </div>
                    <div>
                        <label for="">Estado</label>
                        <select name="estadoSede" id="estadoSede">
                            <option value="Activo">Activo</option>
                            <option value="Inactivo">Inactivo</option>
                        </select>
                    </div>
                    <input type="hidden" name="codArea" id="idSede">
                    <p>Todos los campos (*) son obligatorios</p>
                </div>
                <div class="containerButtonsEditarArea">
                    <input style="background-color: #006B2D;" type="submit" class="btn" value="Actualizar">
                    <button  type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                </div>
            </form>
        </div>
    </div>
</div>
