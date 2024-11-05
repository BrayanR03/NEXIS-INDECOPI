<?php
require_once "../../models/TipoDocumentoIdentidad.php";
require_once "../../config/database.php";

$idTipoDocumentoIdentidad = trim($_POST['idTipoDocumentoIdentidad']);
$descripcion = trim($_POST['descripcion']);
$estado = trim($_POST['estado']);


$tipodocumentoidentidadModel = new TipoDocumentoIdentidad();
$tipodocumentoidentidadModel->setDescripcion($descripcion);
$tipodocumentoidentidadModel->setEstado($estado);
$tipodocumentoidentidadModel->setidTipoDocumentoIdentidad($idTipoDocumentoIdentidad);
$response = $tipodocumentoidentidadModel->actualizarTipoDocumentoIdentidad();
print json_encode($response);
