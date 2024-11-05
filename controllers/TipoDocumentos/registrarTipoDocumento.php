<?php
require_once "../../models/TipoDocumento.php";
require_once "../../config/database.php";

$descripcion = trim($_POST['descripcion']);

$tipoDocumentoModel = new TipoDocumento();
$tipoDocumentoModel->setDescripcion($descripcion);

$response = $tipoDocumentoModel->existeTipoDocumento();

if ($response['message'] == 'Tipo Documento encontrado') {
    print json_encode($response);
} else {
    $tipoDocumentoModel->setDescripcion($descripcion);
    $response = $tipoDocumentoModel->registrarTipoDocumento();
    print json_encode($response);
}

