<div id="modalEditarCasilla" class="modalArea modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Editar Datos de la Casilla</h5>
            </div>
            <form class="formCasilla" id="editarCasillaForm" action="" method="post">
                <div class="seguimiento_body">
                    <div class="detalle">
                        <div class="datosOrigen">
                            <div class="datosOrigenHeader">
                                <h3>
                                    Datos de la Persona
                                </h3>
                                <input id="idPersonaEditarCasilla" hidden readonly>
                            </div>
                            <div class="datosOrigenBody">
                                <div>
                                    <label>Nombres: </label>
                                    <input
                                        type="text" readonly
                                        name="nombresPersonaCasillaEditar"
                                        id="nombresPersonaCasillaEditar">
                                </div>
                                <div>
                                    <label>Tipo Persona: </label>
                                    <input type="text" readonly id="tipoPersonaCasillaEditar" name="tipoPersonaCasillaEditar">
                                </div>
                                <div>
                                    <label>Tipo Documento: </label>
                                    <input type="text" readonly id="tipoDocumentoIdentidadCasillaEditar" name="tipoDocumentoIdentidadCasillaEditar">
                                </div>
                                <div>
                                    <label>Nro Documento: </label>
                                    <input readonly type="text" id="numDocumentoIdentidadPersonaCasillaEditar" name="numDocumentoIdentidadPersonaCasillaEditar">
                                </div>
                                <div>
                                    <label>Representante Legal: </label>
                                    <input type="text" readonly id="representanteLegalCasillaEditar">
                                </div>
                            </div>
                        </div>
                        <div class="datosDestino">
                            <div class="datosDestinoHeader">

                            </div>
                            <div class="datosDestinoBody">
                                <div>
                                    <label>Nro Casilla: </label>
                                    <input readonly class="inputIdCasilla" id="idCasillaAsignarEditar">
                                </div>
                                <div>
                                    <label>Tipo Casilla: </label>
                                    <select class="selectTipoCasilla" id="tipoCasillaAsignarEditar" required>

                                    </select>
                                </div>
                                <div>
                                    <label>Fecha Apertura: </label>
                                    <input type="date" id="fechaAperturaEditar" required placeholder="dd/MM/yyyy" name="fechaAperturaEditar">
                                </div>
                                <div>
                                    <label for="">Estado</label>
                                    <select name="estadoCasilla" id="estadoCasilla">
                                        <option value="Activo">Activo</option>
                                        <option value="Inactivo">Inactivo</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="containerButtonsEditarArea">
                    <input style="background-color: #006B2D;" type="submit" class="btn" value="Editar">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                </div>
                <!-- <input style="background-color: #006B2D;" type="submit" class="btn" value="Registrar">
                <button type="button" class="btnCerrarModal" data-bs-dismiss="modal">Cerrar</button> -->
            </form>

        </div>
    </div>
</div>
<script src="<?= base_url ?>ajax/idUltimaCasilla.js"></script>