<?php
require_once "../../config/database.php";
require_once "../../models/TipoPersonas.php";

$tipoPersonasModel = new TipoPersonas();

$response = $tipoPersonasModel->listarTipoPersonasCombo();

print json_encode($response);