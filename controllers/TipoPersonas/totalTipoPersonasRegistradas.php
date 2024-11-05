<?php
require_once "../../config/database.php";
require_once "../../models/TipoPersonas.php";

$tipoPersonasModel = new TipoPersonas();
$descripcionTipoPersonas=$_GET['descripcionTPFiltro'];
$response = $tipoPersonasModel->obtenerTotalTipoPersonasRegistrados($descripcionTipoPersonas);

print json_encode($response);