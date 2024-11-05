<div id="modalRegistrarPersona" class="modalArea modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
        <div class="modal-content">
            <div style="background-color: #006B2D;" class="modal-header">
                <h5 class="modal-title" style="background-color: #006B2D;" id="exampleModalLabel">Completa los siguientes campos</h5>
            </div>
            <form class="formPersona" id="registrarPersonaForm" action="" method="post">
                <div class="seguimiento_body">
                    <div class="detalle">
                        <div class="datosOrigen">
                            <div style="background-color: #006B2D;" class="datosOrigenHeader">
                                <h3>
                                    Datos Personales
                                </h3>
                            </div>
                            <div class="datosDestino">
                                <div class="datosDestinoBody">
                                    <div>
                                        <label>Tipo Persona(*): </label>
                                        <select autofocus class="selectTipoPersona" required id="tipoPersonaPersonaNuevo">

                                        </select>
                                    </div>
                                    <div>
                                        <label>Tipo Documento(*): </label>
                                        <select disabled class="selectTipoDocumentoIdentidad" required id="tipoDocumentoIdentidadPersonaNuevo">

                                        </select>
                                    </div>
                                    <div>
                                        <label>Estado: </label>
                                        <input
                                            type="text"
                                            placeholder="Activo"
                                            readonly>
                                    </div>
                                    <div class="representanteLegalDiv" hidden>
                                        <label>Representante Legal(*): </label>
                                        <input required
                                            type="text"
                                            autocomplete="off"
                                            name="representanteLegalPersonaNuevo"
                                            id="representanteLegalPersonaNuevo">
                                    </div>
                                    <div>
                                        <label>Nro Documento(*): </label>
                                        <input oninput="this.value = this.value.replace(/[^0-9]/g, '');"
                                            maxlength="" disabled required autocomplete="off" type="text" id="numDocumentoIdentidadPersonaNuevo" name="numDocumentoIdentidadPersonaNuevo">
                                    </div>
                                    <div class="dniCUIDiv" hidden>
                                        <label>Dni CUI(*): </label>
                                        <input oninput="this.value = this.value.replace(/[^0-9]/g, '');"
                                            maxlength="1" type="text" id="CUIPersonaNuevo" autocomplete="off" name="CUIPersonaNuevo">
                                    </div>
                                </div>
                                <div class="datosDestinoHeader" style="background-color: #006B2D;">

                                </div>
                            </div>
                            <div class="datosOrigenBody">
                                <div class="razonSocialDiv" hidden>
                                    <label>Razon Social(*): </label>
                                    <input required
                                        type="text"
                                        name="razonSocialPersonaNuevo"
                                        autocomplete="off"
                                        id="razonSocialPersonaNuevo">
                                </div>
                                <div class="nombresPersonaDiv" hidden>
                                    <label>Nombres(*): </label>
                                    <input required
                                        type="text"
                                        autocomplete="off"
                                        name="nombresPersonaNuevo"
                                        id="nombresPersonaNuevo">
                                </div>
                                <div class="apellidosPersonaDiv" hidden>
                                    <label>Apellidos(*): </label>
                                    <input required
                                        type="text"
                                        autocomplete="off"
                                        name="apellidosPersonaNuevo"
                                        id="apellidosPersonaNuevo">
                                </div>
                                <div>
                                    <label>Email(*): </label>
                                    <input disabled required autocomplete="off" type="email" name="emailPersonaNuevo" id="emailPersonaNuevo">
                                </div>
                                <div>
                                    <label>Teléfono(*): </label>
                                    <input disabled
                                        oninput="this.value = this.value.replace(/[^0-9]/g, '');"
                                        maxlength="9"
                                        type="text" required
                                        autocomplete="off"
                                        name="telefonoPersonaNuevo"
                                        id="telefonoPersonaNuevo">
                                </div>
                                <div>
                                    <label>Domicilio(*): </label>
                                    <input disabled
                                        type="text" required
                                        autocomplete="off"
                                        name="domicilioPersonaNuevo"
                                        id="domicilioPersonaNuevo">
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="containerButtonsEditarArea">
                    <input style="background-color: #006B2D;" type="submit" class="btn" value="Registrar">
                    <button id="cancelar-solicitud-casilla" type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    document.getElementById('tipoPersonaPersonaNuevo').addEventListener('click', function() {
        const select = document.getElementById('tipoPersonaPersonaNuevo');
        const valorSeleccionado = select.value;
        const nombresDiv = document.querySelector('.nombresPersonaDiv'); // Div de Nombres
        const apellidosDiv = document.querySelector('.apellidosPersonaDiv'); // Div de Apellidos
        const dniCUIDiv = document.querySelector('.dniCUIDiv'); // Div de DNI CUI
        const representanteLegalDiv = document.querySelector('.representanteLegalDiv'); // Div de Representante Legal
        const razonSocialDiv = document.querySelector('.razonSocialDiv');
        const tipoDocumentoSelect = document.getElementById('tipoDocumentoIdentidadPersonaNuevo');
        const telefono = document.getElementById('telefonoPersonaNuevo');
        const numDocumento = document.getElementById('numDocumentoIdentidadPersonaNuevo');
        const email = document.getElementById('emailPersonaNuevo');
        const domicilio = document.getElementById('domicilioPersonaNuevo');

        if (valorSeleccionado == 1) {
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
            $("#representanteLegalPersonaNuevo").val("");
            $("#razonSocialPersonaNuevo").val("");
            $("#numDocumentoIdentidadPersonaNuevo").val("");
            // $("#numDocumentoIdentidadPersonaNuevo").val("");
            tipoDocumentoSelect.value = 1;
            tipoDocumentoSelect.disabled = false;
            tipoDocumentoSelect.querySelector('option[value="2"]').disabled = true;
            representanteLegalDiv.querySelector('input').removeAttribute('required');
            razonSocialDiv.querySelector('input').removeAttribute('required');
            // Añadir required a los campos de natural
            nombresDiv.querySelector('input').setAttribute('required', 'required');
            apellidosDiv.querySelector('input').setAttribute('required', 'required');
            dniCUIDiv.querySelector('input').setAttribute('required', 'required');
             // Limitar a 8 caracteres
             


        } else if (valorSeleccionado == 2) {
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
            $("#nombresPersonaNuevo").val("");
            $("#apellidosPersonaNuevo").val("");
            $("#CUIPersonaNuevo").val("");
            // Quitar required de los campos de natural
            nombresDiv.querySelector('input').removeAttribute('required');
            apellidosDiv.querySelector('input').removeAttribute('required');
            dniCUIDiv.querySelector('input').removeAttribute('required');

            // Añadir required a los campos de jurídico
            representanteLegalDiv.querySelector('input').setAttribute('required', 'required');
            razonSocialDiv.querySelector('input').setAttribute('required', 'required');
            $("#numDocumentoIdentidadPersonaNuevo").val("");
            // Limitar a 8 caracteres
        }

    });
    // Nueva función para cambiar el maxlength del campo de documento
    document.getElementById('tipoDocumentoIdentidadPersonaNuevo').addEventListener('change', function() {
        const valorTipoDocumento = this.value;
        const numDocumento = document.getElementById('numDocumentoIdentidadPersonaNuevo');

        if (valorTipoDocumento == 1) {
            numDocumento.setAttribute('maxlength', '8'); // Para tipo documento 1
        } else if (valorTipoDocumento == 3) {
            numDocumento.setAttribute('maxlength', '20'); // Para tipo documento 3
        }
    });
    $(document).off("click", "#cancelar-solicitud-casilla").on('click', "#cancelar-solicitud-casilla", function(e) {
        e.preventDefault();
        const nombresDiv = document.querySelector('.nombresPersonaDiv'); // Div de Nombres
        const apellidosDiv = document.querySelector('.apellidosPersonaDiv'); // Div de Apellidos
        const dniCUIDiv = document.querySelector('.dniCUIDiv'); // Div de DNI CUI
        const representanteLegalDiv = document.querySelector('.representanteLegalDiv'); // Div de Representante Legal
        const razonSocialDiv = document.querySelector('.razonSocialDiv');
        const tipoDocumentoSelect = document.getElementById('tipoDocumentoIdentidadPersonaNuevo');
        const telefono = document.getElementById('telefonoPersonaNuevo');
        const numDocumento = document.getElementById('numDocumentoIdentidadPersonaNuevo');
        const email = document.getElementById('emailPersonaNuevo');
        const domicilio = document.getElementById('domicilioPersonaNuevo');
        nombresDiv.hidden = true;
        apellidosDiv.hidden = true;
        dniCUIDiv.hidden = true;
        razonSocialDiv.hidden = true;
        representanteLegalDiv.hidden = true;
        telefono.disabled = true;
        email.disabled = true;
        domicilio.disabled = true;
        numDocumento.disabled = true;
        tipoDocumentoSelect.disabled=true;

        $("#representanteLegalPersonaNuevo").val("");
        $("#numDocumentoIdentidadPersonaNuevo").val("");
        $("#CUIPersonaNuevo").val("");
        $("#razonSocialPersonaNuevo").val("");
        $("#nombresPersonaNuevo").val("");
        $("#apellidosPersonaNuevo").val("");
        $("#emailPersonaNuevo").val("");
        $("#telefonoPersonaNuevo").val("");
        $("#domicilioPersonaNuevo").val("");
    });
</script>