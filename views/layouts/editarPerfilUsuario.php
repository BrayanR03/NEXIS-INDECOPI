<!-- TIPO PERSONA NATURAL -->
<?php if (trim($_SESSION['TipoPersona']) == 'NATURAL' && trim($_SESSION['TipoUsuario']) == 'ADMINISTRADOR'):  ?>

    <script type="text/javascript">
        window.idUsuario = '<?php echo $_SESSION['idUsuario']; ?>';
        window.usuarioPerfil = '<?php echo $_SESSION['Usuario']; ?>';
        window.usuarioTipoPersona = '<?php echo $_SESSION['TipoPersona']; ?>';
        window.usuarioTipoUsuario = '<?php echo $_SESSION['TipoUsuario']; ?>';
        window.usuarioidCasilla = '<?php echo $_SESSION['idCasilla']; ?>';
        window.usuarioPersona = '<?php echo $_SESSION['Persona']; ?>';
    </script>

    <div id="modalPerfilAdministrador" class="modalArea modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Editar Perfil</h5>
                </div>
                <form class="formPerfilAdministrador" id="editarPerfilAdministradorForm" action="" method="post">
                    <div class="seguimiento_body">
                        <div class="detalle">
                            <div class="datosOrigen">
                                <div class="datosOrigenHeader">
                                    <input hidden type="text" name="idUsuarioNaturalAdministrador" id="idUsuarioNaturalAdministrador">
                                </div>
                                <div class="datosOrigenHeader">
                                </div>
                                <div class="datosOrigenBody">
                                    <div>
                                        <label>Tipo Persona: </label>
                                        <select disabled class="tipoPersonaNaturalAdministrador" required id="tipoPersonaNaturalAdministrador" name="tipoPersonaNaturalAdministrador">
                                            <option value="1">Natural</option>
                                            <option value="2">Juridico</option>
                                        </select>

                                    </div>
                                    <div>
                                        <label>Tipo Documento: </label>
                                        <select disabled class="tipoDocumentoIdentidadNaturalAdministrador" required id="tipoDocumentoIdentidadNaturalAdministrador" name="tipoDocumentoIdentidadNaturalAdministrador">
                                            <option value="1">Dni</option>
                                            <option value="2">Ruc</option>
                                            <option value="3">Pasaporte</option>
                                        </select>

                                    </div>
                                    <!-- <div class="representanteLegalDivPerfil">
                                        <label>Representante Legal</label>
                                        <input
                                            type="text"
                                            name="representanteLegalAdministrador"
                                            id="representanteLegalAdministrador">
                                    </div> -->
                                    <div>
                                        <label>Nro Documento: </label>
                                        <input oninput="this.value = this.value.replace(/[^0-9]/g, '');" required type="text" id="numDocumentoIdentidadNaturalAdministrador" name="numDocumentoIdentidadNaturalAdministrador">
                                    </div>
                                    <div class="dniCUIDivPerfil">
                                        <label>Dni CUI: </label>
                                        <input oninput="this.value = this.value.replace(/[^0-9]/g, '');" maxlength="1" type="text" id="CUIPersonaNaturalAdministrador" name="CUIPersonaNaturalAdministrador">
                                    </div>

                                </div>
                            </div>

                            <div class="datosDestino">
                                <div class="datosDestinoHeader">
                                </div>
                                <div class="datosDestinoBody">
                                    <!-- TIPO PERSONA -->
                                    <div>
                                        <label>Nombres: </label>
                                        <input required
                                            type="text"
                                            name="nombresPersonaNaturalAdministrador"
                                            id="nombresPersonaNaturalAdministrador">
                                    </div>
                                    <div>
                                        <label>Apellidos: </label>
                                        <input required
                                            type="text"
                                            name="apellidosPersonaNaturalAdministrador"
                                            id="apellidosPersonaNaturalAdministrador">
                                    </div>
                                    <div>
                                        <label>Email: </label>
                                        <input required type="email" name="emailPersonaNaturalAdministrador" id="emailPersonaNaturalAdministrador">
                                    </div>
                                    <div>
                                        <label>Teléfono: </label>
                                        <input
                                            type="text" required
                                            oninput="this.value = this.value.replace(/[^0-9]/g, '');"
                                            name="telefonoPersonaNaturalAdministrador"
                                            id="telefonoPersonaNaturalAdministrador">
                                    </div>
                                    <div>
                                        <label>Domicilio: </label>
                                        <input
                                            type="text" required
                                            name="domicilioPersonaNaturalAdministrador"
                                            id="domicilioPersonaNaturalAdministrador">
                                    </div>
                                </div>
                                <div class="datosDestinoHeader">
                                </div>
                                <div class="datosOrigenBody">
                                    <div>
                                        <label>Usuario: </label>
                                        <input readonly type="text" id="usuarioNaturalAdministrador" name="usuarioNaturalAdministrador">
                                    </div>
                                    <div>
                                        <label>Nueva Contraseña: </label>
                                        <i class="fas fa-lock"></i>
                                        <input type="password" id="passwordPersonaNaturalEditarAdministrador" name="passwordPersonaNaturalEditarAdministrador">
                                    </div>
                                    <div>
                                        <label>Confirmar Contraseña: </label>
                                        <i class="fas fa-lock"></i>
                                        <input type="password" id="confirmPasswordNaturalEditarAdministrador" name="confirmPasswordNaturalEditarAdministrador">
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
<?php endif; ?>

<!-- TIPO PERSONA NATURAL -->
<?php if (trim($_SESSION['TipoPersona']) == 'JURIDICO' && trim($_SESSION['TipoUsuario']) == 'ADMINISTRADOR') :  ?>

    <script type="text/javascript">
        window.idUsuario = '<?php echo $_SESSION['idUsuario']; ?>';
        window.usuarioPerfil = '<?php echo $_SESSION['Usuario']; ?>';
        window.usuarioTipoPersona = '<?php echo $_SESSION['TipoPersona']; ?>';
        window.usuarioTipoUsuario = '<?php echo $_SESSION['TipoUsuario']; ?>';
        window.usuarioidCasilla = '<?php echo $_SESSION['idCasilla']; ?>';
        window.usuarioPersona = '<?php echo $_SESSION['Persona']; ?>';

    </script>

    <div id="modalPerfilAdministrador" class="modalArea modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Editar Perfil</h5>
                </div>
                <form class="formPerfilAdministrador" id="editarPerfilAdministradorForm" action="" method="post">
                    <div class="seguimiento_body">
                        <div class="detalle">
                            <div class="datosOrigen">
                                <div class="datosOrigenHeader">
                                    <input hidden type="text" name="idUsuarioJuridicoAdministrador" id="idUsuarioJuridicoAdministrador">
                                </div>
                                <div class="datosOrigenHeader">
                                </div>
                                <div class="datosOrigenBody">
                                    <div>
                                        <label>Tipo Persona: </label>
                                        <select disabled class="tipoPersonaJuridicoAdministrador" required id="tipoPersonaJuridicoAdministrador" name="tipoPersonaJuridicoAdministrador">
                                            <option value="1">Natural</option>
                                            <option value="2">Juridico</option>
                                        </select>

                                    </div>
                                    <div>
                                        <label>Tipo Documento: </label>
                                        <select disabled class="tipoDocumentoIdentidadJuridicoAdministrador" required id="tipoDocumentoIdentidadJuridicoAdministrador" name="tipoDocumentoIdentidadJuridicoAdministrador">
                                            <option value="1">Dni</option>
                                            <option value="2">Ruc</option>
                                            <option value="3">Pasaporte</option>
                                        </select>

                                    </div>
                                    <div>
                                        <label>Representante Legal</label>
                                        <input
                                            type="text"
                                            name="representanteLegalJuridicoAdministrador"
                                            id="representanteLegalJuridicoAdministrador">
                                    </div>
                                    <div>
                                        <label>Nro Documento: </label>
                                        <input required type="text" id="numDocumentoIdentidadJuridicoAdministrador" name="numDocumentoIdentidadJuridicoAdministrador">
                                    </div>
                                    <!-- <div class="dniCUIDivPerfil">
                                        <label>Dni CUI: </label>
                                        <input type="text" id="CUIPersonaAdministrador" name="CUIPersonaAdministrador">
                                    </div> -->

                                </div>
                            </div>

                            <div class="datosDestino">
                                <div class="datosDestinoHeader">
                                </div>
                                <div class="datosDestinoBody">
                                    <!-- TIPO PERSONA -->
                                    <div>
                                        <label>Razon Social: </label>
                                        <input required
                                            type="text"
                                            name="razonSocialPersonaJuridicoAdministrador"
                                            id="razonSocialPersonaJuridicoAdministrador">
                                    </div>
                                    <!-- <div class="apellidosPersonaDivPerfil" >
                                        <label>Apellidos: </label>
                                        <input required
                                            type="text"
                                            name="apellidosPersonaNuevo"
                                            id="apellidosPersonaNuevo">
                                    </div> -->
                                    <div>
                                        <label>Email: </label>
                                        <input required type="email" name="emailPersonaJuridicoAdministrador" id="emailPersonaJuridicoAdministrador">
                                    </div>
                                    <div>
                                        <label>Teléfono: </label>
                                        <input
                                            type="text" required
                                            name="telefonoPersonaJuridicoAdministrador"
                                            id="telefonoPersonaJuridicoAdministrador">
                                    </div>
                                    <div>
                                        <label>Domicilio: </label>
                                        <input
                                            type="text" required
                                            name="domicilioPersonaJuridicoAdministrador"
                                            id="domicilioPersonaJuridicoAdministrador">
                                    </div>
                                </div>
                                <div class="datosDestinoHeader">
                                </div>
                                <div class="datosOrigenBody">
                                    <div>
                                        <label>Usuario: </label>
                                        <input readonly type="text" id="usuarioJuridicoAdministrador" name="usuarioJuridicoAdministrador">
                                    </div>
                                    <div>
                                        <label>Nueva Contraseña: </label>
                                        <i class="fas fa-lock"></i>
                                        <input type="password" id="passwordJuridicoEditarAdministrador" name="passwordJuridicoEditarAdministrador">
                                    </div>
                                    <div>
                                        <label>Confirmar Contraseña: </label>
                                        <i class="fas fa-lock"></i>
                                        <input type="password" id="confirmPasswordJuridicoEditarAdministrador" name="confirmPasswordJuridicoEditarAdministrador">
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
<?php endif; ?>





<?php if (trim($_SESSION['TipoPersona']) == 'NATURAL' && trim($_SESSION['TipoUsuario']) != 'ADMINISTRADOR'):  ?>
    <script type="text/javascript">
        window.idUsuario = '<?php echo $_SESSION['idUsuario']; ?>';
        window.usuarioPerfil = '<?php echo $_SESSION['Usuario']; ?>';
        window.usuarioTipoPersona = '<?php echo $_SESSION['TipoPersona']; ?>';
        window.usuarioTipoUsuario = '<?php echo $_SESSION['TipoUsuario']; ?>';
        window.usuarioidCasilla = '<?php echo $_SESSION['idCasilla']; ?>';
        window.usuarioPersona = '<?php echo $_SESSION['Persona']; ?>';

    </script>

    <div id="modalPerfilNormal" class="modalArea modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Editar Perfil</h5>
                </div>
                <form class="formPerfilNormal" id="editarPerfilNormalForm" action="" method="post">
                    <div class="seguimiento_body">
                        <div class="detalle">
                            <div class="datosOrigen">
                                <div class="datosOrigenHeader">
                                    <input hidden type="text" name="idUsuarioNaturalNormal" id="idUsuarioNaturalNormal">
                                </div>
                                <div class="datosOrigenHeader">
                                </div>
                                <div class="datosOrigenBody">
                                    <div>
                                        <label>Tipo Persona: </label>
                                        <select disabled class="tipoPersonaNaturalNormal" required id="tipoPersonaNaturalNormal" name="tipoPersonaNaturalNormal">
                                            <option value="1">Natural</option>
                                            <option value="2">Juridica</option>
                                        </select>

                                    </div>
                                    <div>
                                        <label>Tipo Documento: </label>
                                        <select disabled class="tipoDocumentoIdentidadNaturalNormal" required id="tipoDocumentoIdentidadNaturalNormal" name="tipoDocumentoIdentidadNaturalNormal">
                                            <option value="1">Dni</option>
                                            <option value="2">Ruc</option>
                                            <option value="3">Pasaporte</option>
                                        </select>

                                    </div>
                                    <!-- <div>
                                            <label>Representante Legal</label>
                                            <input
                                                type="text"
                                                name="representanteLegal"
                                                id="representanteLegal">
                                        </div> -->
                                    <div>
                                        <label>Nro Documento: </label>
                                        <input required type="text" id="numDocumentoIdentidadNaturalNormal" name="numDocumentoIdentidadNaturalNormal">
                                    </div>
                                    <div>
                                        <label>Dni CUI: </label>
                                        <input type="text" id="CUIPersonaNaturalNormal" name="CUIPersonaNaturalNormal">
                                    </div>



                                </div>
                            </div>

                            <div class="datosDestino">
                                <div class="datosDestinoHeader">
                                </div>
                                <div class="datosDestinoBody">


                                    <div>
                                        <label>Nombres: </label>
                                        <input required
                                            type="text"
                                            name="nombresPersonaNaturalNormal"
                                            id="nombresPersonaNaturalNormal">
                                    </div>
                                    <div>
                                        <label>Apellidos: </label>
                                        <input required
                                            type="text"
                                            name="apellidosPersonaNaturalNormal"
                                            id="apellidosPersonaNaturalNormal">
                                    </div>
                                    <div>
                                        <label>Email: </label>
                                        <input required type="email" name="emailPersonaNaturalNormal" id="emailPersonaNaturalNormal">
                                    </div>
                                    <div>
                                        <label>Teléfono: </label>
                                        <input
                                            type="text" required
                                            name="telefonoPersonaNaturalNormal"
                                            id="telefonoPersonaNaturalNormal">
                                    </div>
                                    <div>
                                        <label>Domicilio: </label>
                                        <input
                                            type="text" required
                                            name="domicilioPersonaNaturalNormal"
                                            id="domicilioPersonaNaturalNormal">
                                    </div>
                                </div>
                                <div class="datosDestinoHeader">
                                </div>
                                <div class="datosOrigenBody">
                                    <div>
                                        <label>Usuario: </label>
                                        <input readonly type="text" id="usuarioUsuarioNaturalNormalEditar" name="usuarioUsuarioNaturalNormalEditar">
                                    </div>
                                    <div>
                                        <label>Nueva Contraseña: </label>
                                        <i class="fas fa-lock"></i>
                                        <input type="password" id="passwordUsuarioNaturalNormalEditar" name="passwordUsuarioNaturalNormalEditar">
                                    </div>
                                    <div>
                                        <label>Confirmar Contraseña: </label>
                                        <i class="fas fa-lock"></i>
                                        <input type="password" id="confirmPasswordUsuarioNaturalNormarEditar" name="confirmPasswordUsuarioNaturalNormarEditar">
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
                        <input style="background-color: #006B2D;" type="submit" class="btn" value="Actualizar">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    </div>
                    <!-- <input style="background-color: #006B2D;" type="submit" class="btn" value="Registrar">
                <button type="button" class="btnCerrarModal" data-bs-dismiss="modal">Cerrar</button> -->
                </form>

            </div>
        </div>
    </div>
<?php endif; ?>





<?php if (trim($_SESSION['TipoPersona']) == 'JURIDICO' && trim($_SESSION['TipoUsuario']) != 'ADMINISTRADOR'):  ?>
    <script type="text/javascript">
        window.idUsuario = '<?php echo $_SESSION['idUsuario']; ?>';
        window.usuarioPerfil = '<?php echo $_SESSION['Usuario']; ?>';
        window.usuarioTipoPersona = '<?php echo $_SESSION['TipoPersona']; ?>';
        window.usuarioTipoUsuario = '<?php echo $_SESSION['TipoUsuario']; ?>';
        window.usuarioidCasilla = '<?php echo $_SESSION['idCasilla']; ?>';
        window.usuarioPersona = '<?php echo $_SESSION['Persona']; ?>';

    </script>

    <div id="modalPerfilJuridicoNormal" class="modalArea modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Editar Perfil</h5>
                </div>
                <form class="formPerfilJuridicoNormal" id="editarPerfilJuridicoNormalForm" action="" method="post">
                    <div class="seguimiento_body">
                        <div class="detalle">
                            <div class="datosOrigen">
                                <div class="datosOrigenHeader">
                                    <input hidden type="text" name="idUsuarioJuridicoNormal" id="idUsuarioJuridicoNormal">
                                </div>
                                <div class="datosOrigenHeader">
                                </div>
                                <div class="datosOrigenBody">
                                    <div>
                                        <label>Tipo Persona: </label>
                                        <select disabled class="tipoPersonaJuridicoNormal" required id="tipoPersonaJuridicoNormal" name="tipoPersonaJuridicoNormal">
                                            <option value="1">NATURAL</option>
                                            <option value="2">JURIDICO</option>
                                        </select>

                                    </div>
                                    <div>
                                        <label>Tipo Documento: </label>
                                        <select disabled class="tipoDocumentoIdentidadJuridicoNormal" required id="tipoDocumentoIdentidadJuridicoNormal" name="tipoDocumentoIdentidadJuridicoNormal">
                                            <option value="1">DNI</option>
                                            <option value="2">RUC</option>
                                            <option value="3">PASAPORTE</option>
                                        </select>

                                    </div>
                                    <div>
                                        <label>Representante Legal</label>
                                        <input
                                            type="text"
                                            name="representanteLegalJuridicoNormal"
                                            id="representanteLegalJuridicoNormal">
                                    </div>
                                    <div>
                                        <label>Nro Documento: </label>
                                        <input required type="text" id="numDocumentoIdentidadJuridicoNormal" name="numDocumentoIdentidadJuridicoNormal">
                                    </div>
                                    <!-- <div>
                                            <label>Dni CUI: </label>
                                            <input type="text" id="CUIPersona" name="CUIPersona">
                                        </div> -->

                                </div>
                            </div>

                            <div class="datosDestino">
                                <div class="datosDestinoHeader">
                                </div>
                                <div class="datosDestinoBody">

                                    <div>
                                        <label>Razon Social: </label>
                                        <input required
                                            type="text"
                                            name="razonSocialPersonaJuridicoNormal"
                                            id="razonSocialPersonaJuridicoNormal">
                                    </div>
                                    <div>
                                        <label>Email: </label>
                                        <input required type="email" name="emailPersonaJuridicoNormal" id="emailPersonaJuridicoNormal">
                                    </div>
                                    <div>
                                        <label>Teléfono: </label>
                                        <input
                                            type="text" required
                                            name="telefonoPersonaJuridicoNormal"
                                            id="telefonoPersonaJuridicoNormal">
                                    </div>
                                    <div>
                                        <label>Domicilio: </label>
                                        <input
                                            type="text" required
                                            name="domicilioPersonaJuridicoNormal"
                                            id="domicilioPersonaJuridicoNormal">
                                    </div>



                                </div>
                                <div class="datosDestinoHeader">
                                </div>
                                <div class="datosOrigenBody">
                                    <div>
                                        <label>Usuario: </label>
                                        <input readonly type="text" id="usuarioUsuarioJuridicoNormalEditar" name="usuarioUsuarioJuridicoNormalEditar">
                                    </div>
                                    <div>
                                        <label>Nueva Contraseña: </label>
                                        <i class="fas fa-lock"></i>
                                        <input type="password" id="passwordUsuarioJuridicoNormalEditar" name="passwordUsuarioJuridicoNormalEditar">
                                    </div>
                                    <div>
                                        <label>Confirmar Contraseña: </label>
                                        <i class="fas fa-lock"></i>
                                        <input type="password" id="confirmPasswordUsuarioJuridicoNormalEditar" name="confirmPasswordUsuarioJuridicoNormalEditar">
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
                        <input style="background-color: #006B2D;" type="submit" class="btn" value="Actualizar">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    </div>
                    <!-- <input style="background-color: #006B2D;" type="submit" class="btn" value="Registrar">
                <button type="button" class="btnCerrarModal" data-bs-dismiss="modal">Cerrar</button> -->
                </form>

            </div>
        </div>
    </div>
<?php endif; ?>