<div id="modalEditarUsuario" class="modalArea modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Editar Usuario</h5>
            </div>
            <form class="formUsuario" id="editarUsuarioForm" action="" method="post">
                <div class="seguimiento_body">
                    <div class="detalle">
                        <div class="datosOrigen">
                            <div class="datosOrigenHeader">
                                <h3>
                                    Datos de la Persona
                                </h3>
                                <input hidden id="idPersonaAsignadoEditar"  readonly>
                                <input hidden id="idUsuarioEditarVista"  readonly>
                            </div>
                            <div class="datosOrigenBody">
                                <div>
                                    <label>Nombres: </label>
                                    <input
                                        type="text" readonly
                                        name="nombresPersonaUsuarioEditar"
                                        id="nombresPersonaUsuarioEditar">
                                </div>
                                <div>
                                    <label>Email: </label>
                                    <input readonly type="email" name="emailPersonaUsuarioEditar" id="emailPersonaUsuarioEditar">
                                </div>
                                <div>
                                    <label>Tipo Persona: </label>
                                    <input type="text" readonly id="tipoPersonaUsuarioEditar">
                                </div>
                                <div>
                                    <label>Teléfono: </label>
                                    <input
                                        type="text" readonly
                                        name="telefonoPersonaUsuarioEditar"
                                        id="telefonoPersonaUsuarioEditar">
                                </div>
                                
                                <div>
                                    <label>Tipo Documento: </label>
                                    <input type="text" readonly id="tipoDocumentoIdentidadUsuarioEditar">
                                </div>
                                <div>
                                    <label>Nro Documento: </label>
                                    <input readonly type="text" id="numDocumentoIdentidadPersonaUsuarioEditar" name="numDocumentoIdentidadPersonaUsuarioEditar">
                                </div>
                            </div>
                        </div>
                        <div class="datosDestino">
                            <div class="datosDestinoHeader">

                            </div>
                            <div class="datosDestinoBody">
                                <div>
                                    <label>Tipo Usuario: </label>
                                    <select class="tipoUsuario" required id="tipoUsuarioEditar" name="tipoUsuario">
                                            <option value="1">ADMINISTRADOR</option>
                                            <option value="2">NOTIFICADOR</option>
                                            <option value="3">NORMAL</option>
                                    </select>
                                </div>

                                <div>
                                    <label>Usuario: </label>
                                    <input type="text" id="usuarioUsuarioEditar" name="usuarioUsuarioEditar">   
                                </div>
                                <div>
                                    <label>Nueva Contraseña: </label>
                                    <input type="password" id="passwordUsuarioEditar" minlength="8" oninput="syncPasswords()" name="passwordUsuarioEditar">
                                </div>
                                <div>
                                    <label>Confirmar Contraseña: </label>
                                    <input readonly type="password" id="confirmPasswordUsuarioEditar" name="confirmPasswordUsuarioEditar">
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div>
                <div class="containerButtonsEditarArea">
                    <input style="background-color: #006B2D;" type="submit" class="btn" value="Actualizar">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                </div>
                <!-- <input style="background-color: #006B2D;" type="submit" class="btn" value="Registrar">
                <button type="button" class="btnCerrarModal" data-bs-dismiss="modal">Cerrar</button> -->
            </form>

        </div>
    </div>
</div>

<script>
        function syncPasswords() {
            var password = document.getElementById("passwordUsuarioEditar").value;
            document.getElementById("confirmPasswordUsuarioEditar").value = password;
        }
    </script>