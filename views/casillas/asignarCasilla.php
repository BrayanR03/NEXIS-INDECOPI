<div id="modalAsignarCasilla" class="modalArea modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Asignar Casilla</h5>
            </div>
            <form class="formCasilla" id="asignarCasillaForm" action="" method="post">
                <div class="seguimiento_body">
                    <div class="detalle">
                        <div class="datosOrigen">
                            <div class="datosOrigenHeader">
                                <h3>
                                    Datos de la Persona
                                </h3>
                                <input id="idPersonaAsignadoCasilla" hidden readonly>
                            </div>
                            <div class="datosOrigenBody">
                                <div>
                                    <label>Nombres: </label>
                                    <input
                                        type="text" readonly
                                        name="nombresPersonaCasilla"
                                        id="nombresPersonaCasilla">
                                </div>
                                <div>
                                    <label>Tipo Persona: </label>
                                    <input type="text" readonly id="tipoPersonaCasilla" name="tipoPersonaCasilla">
                                </div>
                                <div>
                                    <label>Tipo Documento: </label>
                                    <input type="text" readonly id="tipoDocumentoIdentidadCasilla" name="tipoDocumentoIdentidadCasilla">
                                </div>
                                <div>
                                    <label>Nro Documento: </label>
                                    <input readonly type="text" id="numDocumentoIdentidadPersonaCasilla" name="numDocumentoIdentidadPersonaCasilla">
                                </div>
                                <div>
                                    <label>Representante Legal: </label>
                                    <input type="text" readonly id="representanteLegalCasilla">
                                </div>
                            </div>
                        </div>
                        <div class="datosDestino">
                            <div class="datosDestinoHeader">

                            </div>
                            <div class="datosDestinoBody">
                                <div>
                                    <label>Nro Casilla: </label>
                                    <input readonly class="inputIdCasilla" id="idCasillaAsignar">
                                </div>
                                <div>
                                    <label>Tipo Casilla: </label>
                                    <select class="selectTipoCasilla" id="tipoCasillaAsignar" required >

                                    </select>
                                </div>
                                <div>
                                    <label>Fecha Apertura: </label>
                                    <input type="date" id="fechaApertura" required placeholder="dd/MM/yyyy" name="fechaApertura">
                                </div>
                            </div>
                        </div>
                        <!-- <div class="containerObservacion">
                        <div>
                            <label>Observación</label>
                            <textarea
                                class="disabled form-control"
                                name="observacion"
                                id="observacionDetalle"
                                readonly>
                        </textarea>
                        </div>
                    </div> -->
                    </div>
                </div>
                <div class="containerButtonsEditarArea">
                    <input style="background-color: #006B2D;" type="submit" class="btn" value="Asignar">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                </div>
                <!-- <input style="background-color: #006B2D;" type="submit" class="btn" value="Registrar">
                <button type="button" class="btnCerrarModal" data-bs-dismiss="modal">Cerrar</button> -->
            </form>

        </div>
    </div>
</div>
<script src="<?= base_url ?>ajax/idUltimaCasilla.js"></script>