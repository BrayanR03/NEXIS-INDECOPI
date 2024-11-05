<div id="modalEstadoSede" class="modalArea modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #006B2D;">
                <h5 class="modal-title" id="exampleModalLabel">Cambiar Estado de la Sede</h5>
            </div>
            <form class="formArea" id="editarEstadoSedeForm" action="" method="post">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="descripcionSedeEstado" class="form-label">Descripción:</label>
                        <input readonly type="text" class="descripcionSede" id="descripcionSedeEstado" autocomplete="off">
                    </div>
                    <div class="mb-3">
                        <label for="estadoSede" class="form-label">Estado:</label>
                        <select name="estadoSede" id="estadoSede">
                            <option value="Habilitada">Habilitada</option>
                            <option value="Inhabilitada">Inhabilitada</option>
                        </select>
                        <!-- <input readonly type="text" class="estadoArea" id="estadoArea" autocomplete="off"> -->
                    </div>
                    <input type="hidden" name="idSedeEstado" id="idSedeEstado">
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
