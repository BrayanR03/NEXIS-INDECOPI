<?php
require_once "../../config/database.php";
require_once "../../models/TipoCasilla.php";

$tipoCasillasModel = new TipoCasilla();

$response = $tipoCasillasModel->ListadoTipoCasillasCombo();

print json_encode($response);