<?php
require_once('../../config/parameters.php');
?>

<div class="containerListadoArea">
    <div class="listadoAreas_header">
        <div>
            <h3 style="font-weight: bold;">GESTIÓN DE CASILLAS</h3>
            <p style="color: #006B2D;">LISTADO DE CASILLAS</p>
            <div class="containerFiltrado">
                <div>
                    <label for="">Todos los Usuarios</label>
                    <input type="radio" checked name="filtroBusqueda" id="usuariosAll" value="usuariosAll">
                </div>
                <div>
                    <label for="">Usuarios Sin Casillas</label>
                    <input type="radio" name="filtroBusqueda" id="sinCasilla" value="sinCasilla">
                </div>
                <div>
                    <label for="">Usuarios Con Casillas</label>
                    <input type="radio" name="filtroBusqueda" id="conCasilla" value="conCasilla">
                </div>

            </div>
            <div class="busqueda">
                <svg width="26" height="24" viewBox="0 0 26 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M24.25 22.5002L18.8213 17.4334M18.8213 17.4334C19.7499 16.5667 20.4865 15.5378 20.989 14.4054C21.4916 13.273 21.7503 12.0593 21.7503 10.8336C21.7503 9.60787 21.4916 8.39417 20.989 7.26177C20.4865 6.12937 19.7499 5.10044 18.8213 4.23374C17.8927 3.36704 16.7902 2.67953 15.5769 2.21048C14.3637 1.74142 13.0633 1.5 11.75 1.5C10.4368 1.5 9.13637 1.74142 7.92308 2.21048C6.70979 2.67953 5.60737 3.36704 4.67876 4.23374C2.80335 5.98413 1.74976 8.35816 1.74976 10.8336C1.74976 13.309 2.80335 15.683 4.67876 17.4334C6.55418 19.1838 9.09778 20.1671 11.75 20.1671C14.4022 20.1671 16.9459 19.1838 18.8213 17.4334Z" stroke="#0C7260" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />-->
                </svg>
                <input
                    id="datosBusquedaFiltro"
                    type="text"
                    name="datosBusquedaFiltro"
                    value=""
                    autocomplete="off"
                    placeholder="Buscar el Usuario">
            </div>
        </div>

    </div>
    <div class="text-end">
        <p class="fs-6">Total de registros: <span class="fw-bold" id="totalCasillasRegistradas"></span></p>
        <div>
            <ul class="listadoOpcionesPaginacion" id="opcionesPaginacionAreas">
            </ul>
        </div>
    </div>
    <div class="listadoAreas_body container-table" style="margin-top: 15px;">
        <table>
            <thead>
                <tr>
                    <th>Tipo Casilla</th>
                    <th>Nro Casilla</th>
                    <th>Fecha Apertura</th>
                    <th hidden>Id Persona</th>
                    <th>Persona</th>
                    <th>Tipo Persona</th>
                    <th>Documento Identidad</th>
                    <th>Nro Documento Identidad</th>
                    <th>Representante Legal</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody id="bodyListaCasillas">

            </tbody>
        </table>
    </div>
</div>
<?php  require_once "asignarCasilla.php"?>
<?php  require_once "editarCasillas.php"?>
<script src="<?= base_url ?>ajax/casillas.js"></script>
<script src="<?= base_url ?>ajax/tipocasillas.js"></script>