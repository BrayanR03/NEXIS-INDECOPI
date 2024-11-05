<?php
require_once "../../models/TipoPersonas.php";
require_once "../../config/database.php";

$idTipoPersona = trim($_POST['idTipoPersona']);
$descripcion = trim($_POST['descripcion']);
$estado = trim($_POST['estado']);


$tipoPersonaModel = new TipoPersonas();
$tipoPersonaModel->setDescripcion($descripcion);
$tipoPersonaModel->setEstado($estado);
$tipoPersonaModel->setidTipoPersona($idTipoPersona);
$response = $tipoPersonaModel->actualizarTipoPersona();
print json_encode($response);
