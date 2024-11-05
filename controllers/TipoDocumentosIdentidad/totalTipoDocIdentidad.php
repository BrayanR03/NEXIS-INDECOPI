<?php
require_once "../../config/database.php";
require_once "../../models/TipoDocumentoIdentidad.php";

$tipoDocumentoIdentidad = new TipoDocumentoIdentidad();
$descripcionTipoDocId=$_GET['descripcionTDIFiltro'];
$response = $tipoDocumentoIdentidad->obtenerTotalTipoDocumentosIdentidadRegistrados($descripcionTipoDocId);

print json_encode($response);