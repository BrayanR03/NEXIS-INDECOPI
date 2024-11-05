<?php
require_once('../../config/parameters.php');
?>

<div class="containerListadoArea">
    <div class="listadoAreas_header">
        <div>
            <h3 style="font-weight: bold;">GESTIÓN DE SEDES</h3>
            <p style="color: #006B2D;">LISTADO DE SEDES</p>
            <div class="containerFiltrado">
                <div class="busqueda">
                    <svg width="26" height="24" viewBox="0 0 26 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M24.25 22.5002L18.8213 17.4334M18.8213 17.4334C19.7499 16.5667 20.4865 15.5378 20.989 14.4054C21.4916 13.273 21.7503 12.0593 21.7503 10.8336C21.7503 9.60787 21.4916 8.39417 20.989 7.26177C20.4865 6.12937 19.7499 5.10044 18.8213 4.23374C17.8927 3.36704 16.7902 2.67953 15.5769 2.21048C14.3637 1.74142 13.0633 1.5 11.75 1.5C10.4368 1.5 9.13637 1.74142 7.92308 2.21048C6.70979 2.67953 5.60737 3.36704 4.67876 4.23374C2.80335 5.98413 1.74976 8.35816 1.74976 10.8336C1.74976 13.309 2.80335 15.683 4.67876 17.4334C6.55418 19.1838 9.09778 20.1671 11.75 20.1671C14.4022 20.1671 16.9459 19.1838 18.8213 17.4334Z" stroke="#0C7260" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />-->
                    </svg>
                    <input
                        id="Descripcion"
                        type="text"
                        name="Descripcion"
                        value=""
                        autocomplete="off"
                        placeholder="Nombre del Área">
                </div>
            </div>
        </div>
        <a href="" style="background-color: #006B2D;" id="btnRegistrarSede" class="btnNuevoRegistro">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                <path fill="#ffffff" d="M256 80c0-17.7-14.3-32-32-32s-32 14.3-32 32V224H48c-17.7 0-32 14.3-32 32s14.3 32 32 32H192V432c0 17.7 14.3 32 32 32s32-14.3 32-32V288H400c17.7 0 32-14.3 32-32s-14.3-32-32-32H256V80z" />
            </svg>
            Registrar Nueva Sede
        </a>
    </div>
    <div class="text-end">
        <p class="fs-6">Total de registros: <span class="fw-bold" id="totalSedesRegistradas"></span></p>
        <div>
            <ul class="listadoOpcionesPaginacion" id="opcionesPaginacionAreas">
            </ul>
        </div>
    </div>
    <div class="listadoAreas_body container-table" style="margin-top: 15px;">
        <table>
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Descripcion</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody id="bodyListaSedes">

            </tbody>
        </table>
    </div>
</div>

<?php  require_once "registroSede.php"?>
<?php  require_once "editarSede.php"?>

<script src="<?= base_url ?>ajax/sedes.js"></script>