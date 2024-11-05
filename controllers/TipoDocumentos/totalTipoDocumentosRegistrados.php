<?php
require_once "../../config/database.php";
require_once "../../models/TipoDocumento.php";

$tipoDocumentoModel = new TipoDocumento();
$descripcionTD=$_GET['descripcionTDFiltro'];
$response = $tipoDocumentoModel->obtenerTotalTipoDocumentosRegistrados($descripcionTD);

print json_encode($response);