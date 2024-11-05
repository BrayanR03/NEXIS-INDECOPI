<?php
require_once "../../config/database.php";
require_once "../../models/TipoDocumentoIdentidad.php";

$tipoDocumentoIdentidadModel = new TipoDocumentoIdentidad();

$response = $tipoDocumentoIdentidadModel->listarTipoDocumentoIdentidadCombo();

print json_encode($response);