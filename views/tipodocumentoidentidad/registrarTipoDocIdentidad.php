<div id="modalRegistrarTipoDocumentoIdentidad" class="modalArea modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #006B2D;">
                <h5 class="modal-title" id="exampleModalLabel">Registrar Nuevo Tipo Documento de Identidad</h5>
            </div>
            <form class="formTipoDocumentoIdentidad" id="registrarTipoDocumentoIdentidadForm" action="" method="post">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="descripcionArea" class="form-label">Descripción (*):</label>
                        <input type="text" id="descripcionTipoDocumentoIdentidadNuevo" autocomplete="off">
                    </div>
                    <p>Todos los campos (*) son obligatorios</p>
                </div>
                <div class="containerButtonsEditarArea">
                    <input style="background-color: #006B2D;" type="submit" class="btn" value="Registrar">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                </div>
            </form>
        </div>
    </div>
</div>