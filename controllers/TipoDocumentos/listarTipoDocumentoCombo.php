<?php
require_once "../../config/database.php";
require_once "../../models/TipoDocumento.php";

$tipoDocumentoModel = new TipoDocumento();

$response = $tipoDocumentoModel->listarTipoDocumentoCombo();

print json_encode($response);