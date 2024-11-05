<?php
require_once "../../models/TipoDocumentoIdentidad.php";
require_once "../../config/database.php";

$descripcion = trim($_POST['descripcion']);

$tipoDocumentoidentidadModel = new TipoDocumentoIdentidad();
$tipoDocumentoidentidadModel->setDescripcion($descripcion);

$response = $tipoDocumentoidentidadModel->existeTipoDocumentoIdentidad();

if ($response['message'] == 'Tipo Documento Identidad encontrado') {
    print json_encode($response);
} else {
    $tipoDocumentoidentidadModel->setDescripcion($descripcion);
    $response = $tipoDocumentoidentidadModel->registrarTipoDocumento();
    print json_encode($response);
}

