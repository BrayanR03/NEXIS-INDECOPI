<?php
require_once "../../models/TipoDocumento.php";
require_once "../../config/database.php";

$idTipoDocumento = trim($_POST['idTipoDocumento']);
$descripcion = trim($_POST['descripcion']);
$estado = trim($_POST['estado']);


$tipoDocumentoModel = new TipoDocumento();
$tipoDocumentoModel->setDescripcion($descripcion);
$tipoDocumentoModel->setEstado($estado);
$tipoDocumentoModel->setidTipoDocumento($idTipoDocumento);
$response = $tipoDocumentoModel->actualizarTipoDocumento();
print json_encode($response);
