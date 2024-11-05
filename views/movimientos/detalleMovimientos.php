<div id="modalDetalleMovimientoUsuarioNormal" class="modalArea modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Detalle Notificación</h5>
            </div>
            <form class="detalleMovimientoFormUsuarioNormal" id="detalleMovimientoFormUsuarioNormal" action="" method="post">
                <div class="seguimiento_body">
                    <div class="detalle">
                        <div class="datosOrigen">
                            <div class="datosOrigenHeader">
                                <h3>
                                    Acto Administrativo
                                </h3>
                                <input hidden id="idMovimientoDocumentoUsuarioNormal" readonly>
                            </div>
                            <div class="datosOrigenBody">
                                <div>
                                    <label>Tipo Documento: </label>
                                    <input
                                        type="text" readonly
                                        name="tipoDocumentoUsuarioNormal"
                                        id="tipoDocumentoUsuarioNormal">
                                </div>
                                <div>
                                    <label>Nro Documento: </label>
                                    <input readonly type="text" name="nroDocumentoUsuarioNormal" id="nroDocumentoUsuarioNormal">
                                </div>
                                <div>
                                    <label>Documento: </label>
                                    <input type="text" readonly id="nombreDocumentoUsuarioNormal">
                                </div>
                                <div>
                                    <label>Fecha Notificación: </label>
                                    <input
                                        type="text" readonly
                                        name="fechaNotificacionUsuarioNormal"
                                        id="fechaNotificacionUsuarioNormal">
                                </div>

                                <div>
                                    <label>Fecha Documento: </label>
                                    <input type="text" readonly id="fechaDocumentoUsuarioNormal">
                                </div>

                            </div>
                        </div>
                        <div class="datosDestino">
                            <div class="datosDestinoHeader">

                            </div>
                            <div class="datosDestinoBody">
                                <div>
                                    <label>Sumilla: </label>
                                    <textarea name="sumillaDocumentoUsuarioNormal" id="sumillaDocumentoUsuarioNormal"></textarea>
                                    <!-- <input readonly type="text" id="numDocumentoIdentidadPersonaUsuarioEditar" name="numDocumentoIdentidadPersonaUsuarioEditar"> -->
                                </div>
                                <div>
                                    <label>Area: </label>
                                    <input type="text" name="areaDocumentoUsuarioNormal" id="areaDocumentoUsuarioNormal">
                                </div>

                                <div>
                                    <label>Sede: </label>
                                    <input type="text" id="sedeDocumentoUsuarioNormal" name="sedeDocumentoUsuarioNormal">
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="containerButtonsEditarArea">
                    <input style="background-color: #006B2D;" id="btnDescargarDocumento" type="button" class="btn" value="Descargar Documento">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                </div>
                <!-- <input style="background-color: #006B2D;" type="submit" class="btn" value="Registrar">
                <button type="button" class="btnCerrarModal" data-bs-dismiss="modal">Cerrar</button> -->
            </form>

        </div>
    </div>
</div>