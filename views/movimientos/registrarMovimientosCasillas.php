<div id="modalRegistrarMovimientoCasilla" class="modalArea modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Envío de Notificación</h5>
            </div>
            <!-- Pantalla de carga -->
            <div id="loading-screen" class="loading-screen">
                <div class="loader"></div>
            </div>
            <form class="formMovimiento" id="registrarMovimientoCasillaForm" enctype="multipart/form-data" action="" method="post">
                <div class="seguimiento_body">
                    <div class="detalle">
                        <div class="datosOrigen">
                            <div class="datosOrigenHeader">
                                <h3>
                                    Datos del Usuario
                                </h3>
                                <input id="idPersonaAsignado" hidden readonly>
                            </div>
                            <div class="listadoAreas_body" style="margin-top: 15px;">

                            </div>
                        </div>
                        <div class="datosDestino">
                            <div class="busqueda">
                                <svg width="26" height="24" viewBox="0 0 26 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M24.25 22.5002L18.8213 17.4334M18.8213 17.4334C19.7499 16.5667 20.4865 15.5378 20.989 14.4054C21.4916 13.273 21.7503 12.0593 21.7503 10.8336C21.7503 9.60787 21.4916 8.39417 20.989 7.26177C20.4865 6.12937 19.7499 5.10044 18.8213 4.23374C17.8927 3.36704 16.7902 2.67953 15.5769 2.21048C14.3637 1.74142 13.0633 1.5 11.75 1.5C10.4368 1.5 9.13637 1.74142 7.92308 2.21048C6.70979 2.67953 5.60737 3.36704 4.67876 4.23374C2.80335 5.98413 1.74976 8.35816 1.74976 10.8336C1.74976 13.309 2.80335 15.683 4.67876 17.4334C6.55418 19.1838 9.09778 20.1671 11.75 20.1671C14.4022 20.1671 16.9459 19.1838 18.8213 17.4334Z" stroke="#0C7260" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                                <input
                                    id="datosBusquedaFiltro"
                                    type="text"
                                    name="datosBusquedaFiltro"
                                    value=""
                                    autofocus
                                    autocomplete="off"
                                    placeholder="Buscar Usuario">
                            </div>
                            <div class="datosDestinoHeader">
                                <div class="listadoAreas_body container-table-usuario-notificacion" style="margin-top: 15px;">
                                    <table>
                                        <thead>
                                            <tr>
                                                <th>Persona</th>
                                                <th>Tipo Persona</th>
                                                <th>Nro Documento Identidad</th>
                                                <th>Nro Casilla</th>
                                                <th>Tipo Casilla</th>
                                                <th>Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody id="bodyListaCasillasNotificacion">

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="datosDestinoBody" hidden id="datosMovimiento">
                                <div>
                                    <label>Nro Casilla: </label>
                                    <input type="text" required readonly id="NroCasillaNotificacion">
                                </div>
                                <div>
                                    <label>Tipo Documento: </label>
                                    <select class="selectTipoDocumentoNotificacion" required id="tipoDocumentoNotificacion">

                                    </select>
                                </div>
                                <input type="email" hidden name="emailDestino" id="emailDestino">
                                <div>
                                    <label>Nro Documento: </label>
                                    <input type="text" required id="nroDocumento" name="nroDocumento">
                                </div>
                                <div>
                                    <label>Fecha Documento: </label>
                                    <input type="date" required id="fechaDocumento" name="fechaDocumento">
                                </div>
                                <div>
                                    <label>Fecha Notificación: </label>
                                    <input type="date" required id="fechaNotificacion" name="fechaNotificacion">
                                </div>
                                <div>
                                    <label>Adjuntar Documento: </label>
                                    <input type="file" accept=".pdf, .doc, .docx" id="archivoDocumento" name="archivoDocumento">
                                </div>
                                <div>
                                    <label>Sumilla: </label>
                                    <textarea name="sumilla" id="sumilla"></textarea>
                                </div>
                                <div>
                                    <label>Area: </label>
                                    <select class="selectArea" required id="areaNotificacion">

                                    </select>
                                </div>
                                <div>
                                    <label>Sede: </label>
                                    <select class="selectSede" required id="sedeNotificacion">

                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="containerButtonsEditarArea">
                    <input style="background-color: #006B2D;" type="submit" class="btn" value="Registrar">
                    <button type="button" class="btn btn-secondary" id="cancelarNotificacion" data-bs-dismiss="modal">Cancelar</button>
                </div>
                <!-- <input style="background-color: #006B2D;" type="submit" class="btn" value="Registrar">
                <button type="button" class="btnCerrarModal" data-bs-dismiss="modal">Cerrar</button> -->
            </form>
        </div>
    </div>
</div>
