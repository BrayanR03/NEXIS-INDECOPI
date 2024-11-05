<div id="modalEditarPersona" class="modalArea modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Editar Datos de la Persona</h5>
            </div>
            <form class="formPersona" id="editarPersonaForm" action="" method="post">
                <div class="seguimiento_body">
                    <div class="detalle">
                        <div class="datosOrigen">
                            <div class="datosOrigenHeader">
                                <h3>
                                    Datos Personales
                                </h3>
                                <input hidden type="text" name="idPersona" id="idPersona">
                            </div>
                            <div class="datosOrigenBody">
                                <div>
                                    <label>Nombres: </label>
                                    <input required
                                        type="text"
                                        name="nombresPersona"
                                        id="nombresPersona">
                                </div>
                                <div>
                                    <label>Email: </label>
                                    <input required type="email" name="emailPersona" id="emailPersona">
                                </div>
                                <div>
                                    <!-- <label>Documento Identidad:</label>
                                <input
                                        type="text"
                                        name="representanteLegalPersonaNuevo"
                                        id="representanteLegalPersonaNuevo"> -->
                                </div>
                                <div>
                                    <label>Apellidos: </label>
                                    <input required
                                        type="text"
                                        name="apellidosPersona"
                                        id="apellidosPersona">
                                </div>
                                <div>
                                    <label>Teléfono: </label>
                                    <input oninput="this.value = this.value.replace(/[^0-9]/g, '');"
                                        type="text" required
                                        name="telefonoPersona"
                                        id="telefonoPersona">
                                </div>
                                <div>
                                    <label>Domicilio: </label>
                                    <input
                                        type="text" required
                                        name="domicilioPersona"
                                        id="domicilioPersona">
                                </div>
                            </div>
                        </div>

                        <div class="datosDestino">
                            <div class="datosDestinoHeader">
                            </div>
                            <div class="datosDestinoBody">
                                <div>
                                    <label>Tipo Persona: </label>
                                    <select disabled class="tipoPersona" required id="tipoPersonaEditar" name="tipoPersona">
                                        <option value="1">Natural</option>
                                        <option value="2">Juridica</option>
                                    </select>

                                </div>
                                <div>
                                    <label>Tipo Documento: </label>
                                    <select disabled class="tipoDocumentoIdentidad" required id="tipoDocumentoIdentidadEditar" name="tipoDocumentoIdentidad">
                                        <option value="1">DNI</option>
                                        <option value="2">RUC</option>
                                        <option value="3">PASAPORTE</option>
                                    </select>

                                </div>
                                <!-- <div>
                                    <label>Estado: </label>
                                    <input
                                        type="text"
                                        id="estadoPersonaEditar"
                                        name="estadoPersonaEditar"
                                        readonly>
                                </div> -->
                                <div class="mb-3">
                                    <label for="estadoArea" class="form-label">Estado:</label>
                                    <select name="estadoPersonaEditar" id="estadoPersonaEditar">
                                        <option value="Activo">Activo</option>
                                        <option value="Inactivo">Inactivo</option>
                                    </select>
                                </div>
                                <div>
                                    <label>Representante Legal</label>
                                    <input
                                        type="text"
                                        name="representanteLegal"
                                        id="representanteLegal">
                                </div>
                                <div>
                                    <label>Nro Documento: </label>
                                    <input oninput="this.value = this.value.replace(/[^0-9]/g, '');" required type="text" id="numDocumentoIdentidad" name="numDocumentoIdentidad">
                                </div>
                                <div>
                                    <label>Dni CUI: </label>
                                    <input oninput="this.value = this.value.replace(/[^0-9]/g, '');" maxlength="1" type="text" id="CUIPersona" name="CUIPersona">
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
<script>
    document.getElementById('tipoPersonaEditar').addEventListener('click', function() {
        const select = document.getElementById('tipoPersonaEditar');
        const valorSeleccionado = select.value;
        const nombresDiv = document.querySelector('.nombresPersonaDiv'); // Div de Nombres
        const apellidosDiv = document.querySelector('.apellidosPersonaDiv'); // Div de Apellidos
        const dniCUIDiv = document.querySelector('.dniCUIDiv'); // Div de DNI CUI
        const representanteLegalDiv = document.querySelector('.representanteLegalDiv'); // Div de Representante Legal
        const razonSocialDiv = document.querySelector('.razonSocialDiv');
        const tipoDocumentoSelect = document.getElementById('tipoDocumentoIdentidadEditar');
        const telefono = document.getElementById('telefonoPersona');
        const numDocumento = document.getElementById('numDocumentoIdentidad');
        const email = document.getElementById('emailPersona');
        const domicilio = document.getElementById('domicilioPersona');

        if (valorSeleccionado == 1) { // Persona Natural
            numDocumento.setAttribute('maxlength', '8');
            // Mostrar campos de persona natural
            nombresDiv.hidden = false;
            apellidosDiv.hidden = false;
            dniCUIDiv.hidden = false;
            razonSocialDiv.hidden = true;
            representanteLegalDiv.hidden = true;
            telefono.disabled = false;
            email.disabled = false;
            domicilio.disabled = false;
            numDocumento.disabled = false;
            tipoDocumentoSelect.value = 1;
            tipoDocumentoSelect.disabled = false;
            tipoDocumentoSelect.querySelector('option[value="2"]').disabled = true;
            representanteLegalDiv.querySelector('input').removeAttribute('required');
            razonSocialDiv.querySelector('input').removeAttribute('required');
            // Añadir required a los campos de natural
            nombresDiv.querySelector('input').setAttribute('required', 'required');
            apellidosDiv.querySelector('input').setAttribute('required', 'required');
            dniCUIDiv.querySelector('input').setAttribute('required', 'required');

        } else if (valorSeleccionado == 2) { // Persona Jurídica
            numDocumento.setAttribute('maxlength', '11'); 
            nombresDiv.hidden = true;
            apellidosDiv.hidden = true;
            dniCUIDiv.hidden = true;
            representanteLegalDiv.hidden = false;
            razonSocialDiv.hidden = false;
            tipoDocumentoSelect.value = 2;
            tipoDocumentoSelect.disabled = true;
            telefono.disabled = false;
            email.disabled = false;
            domicilio.disabled = false;
            numDocumento.disabled = false;
            // Quitar required de los campos de natural
            nombresDiv.querySelector('input').removeAttribute('required');
            apellidosDiv.querySelector('input').removeAttribute('required');
            dniCUIDiv.querySelector('input').removeAttribute('required');

            // Añadir required a los campos de jurídico
            representanteLegalDiv.querySelector('input').setAttribute('required', 'required');
            razonSocialDiv.querySelector('input').setAttribute('required', 'required');
        }

    });

    // Función para cambiar el maxlength del campo de documento según el tipo de documento
    document.getElementById('tipoDocumentoIdentidadEditar').addEventListener('change', function() {
        const valorTipoDocumento = this.value;
        const numDocumento = document.getElementById('numDocumentoIdentidad');

        if (valorTipoDocumento == 1) { // DNI
            numDocumento.setAttribute('maxlength', '8');
        } else if (valorTipoDocumento == 3) { // Pasaporte
            numDocumento.setAttribute('maxlength', '20');
        }
    });

</script>
