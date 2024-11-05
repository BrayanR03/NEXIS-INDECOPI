<div id="modalAsignarUsuario" class="modalArea modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Asignar Usuario</h5>
            </div>
            <!-- Pantalla de carga -->
            <div id="loading-screen" class="loading-screen">
                <div class="loader"></div>
            </div>

            <form class="formUsuario" id="asignarUsuarioForm" action="" method="post">
                <div class="seguimiento_body">
                    <div class="detalle">
                        <div class="datosOrigen">
                            <div class="datosOrigenHeader">
                                <h3>
                                    Datos de la Persona
                                </h3>
                                <input id="idPersonaAsignado" hidden readonly>
                            </div>
                            <div class="datosOrigenBody">
                                <div>
                                    <label>Nombres: </label>
                                    <input
                                        type="text" readonly
                                        name="nombresPersonaUsuario"
                                        id="nombresPersonaUsuario">
                                </div>
                                <div>
                                    <label>Email: </label>
                                    <input readonly type="email" name="emailPersonaUsuario" id="emailPersonaUsuario">
                                </div>
                                <div>
                                    <label>Tipo Persona: </label>
                                    <input type="text" readonly id="tipoPersonaUsuario">
                                </div>
                                <div>
                                    <label>Teléfono: </label>
                                    <input
                                        type="text" readonly
                                        name="telefonoPersonaUsuario"
                                        id="telefonoPersonaUsuario">
                                </div>

                                <div>
                                    <label>Tipo Documento: </label>
                                    <input type="text" readonly id="tipoDocumentoIdentidadUsuario">
                                </div>
                                <div>
                                    <label>Nro Documento: </label>
                                    <input readonly type="text" id="numDocumentoIdentidadPersonaUsuario" name="numDocumentoIdentidadPersonaUsuario">
                                </div>
                            </div>
                        </div>
                        <div class="datosDestino">
                            <div class="datosDestinoHeader">

                            </div>
                            <div class="datosDestinoBody">
                                <div>
                                    <label>Tipo Usuario: </label>
                                    <select class="selectTipoUsuario" required id="tipoUsuarioAsignar">

                                    </select>
                                </div>

                                <div>
                                    <label>Usuario: </label>
                                    <input type="text" required id="usuarioUsuario" name="usuarioUsuario">
                                </div>
                                <div>
                                    <label>Contraseña: </label>
                                    <input type="password" minlength="8" required id="passwordUsuario" oninput="syncPasswordsAsign()" name="passwordUsuario">
                                </div>
                                <div>
                                    <label>Confirmar Contraseña: </label>
                                    <input type="password" readonly id="confirmPasswordUsuario" name="confirmPasswordUsuario">
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
<script>
    function syncPasswordsAsign() {
        var password = document.getElementById("passwordUsuario").value;
        document.getElementById("confirmPasswordUsuario").value = password;
    }
</script>