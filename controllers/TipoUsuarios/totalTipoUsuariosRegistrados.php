<?php
require_once "../../config/database.php";
require_once "../../models/TipoUsuarios.php";

$tipousuariosModel = new TipoUsuarios();
$descripcionTipoUsuarios=$_GET['descripcionTUFiltro'];
$response = $tipousuariosModel->obtenerTotalTipoUsuariosRegistrados($descripcionTipoUsuarios);

print json_encode($response);