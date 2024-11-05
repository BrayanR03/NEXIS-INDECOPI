<div id="modalEstadoPersona" class="modalArea modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #006B2D;">
                <h5 class="modal-title" id="exampleModalLabel">Cambiar Estado de la Persona</h5>
            </div>
            <form class="formPersona" id="editarEstadoPersonaForm" action="" method="post">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="descripcionAreaEstado" class="form-label">Nombres:</label>
                        <input readonly type="text" class="nombresPersona" id="nombresPersonaEstado" autocomplete="off">
                    </div>
                    <div class="mb-3">
                        <label for="estadoArea" class="form-label">Estado:</label>
                        <select name="estadoPersona" id="estadoPersona">
                            <option value="Activo">Activo</option>
                            <option value="Inactivo">Inactivo</option>
                        </select>
                        <!-- <input readonly type="text" class="estadoArea" id="estadoArea" autocomplete="off"> -->
                    </div>
                    <input type="hidden" name="idPersonaEstado" id="idPersonaEstado">
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
