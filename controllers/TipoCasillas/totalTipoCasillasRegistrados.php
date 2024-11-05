<?php
require_once "../../config/database.php";
require_once "../../models/TipoCasilla.php";

$tipocasillaModel = new TipoCasilla();
$descripcionTipoCasillas=$_GET['descripcionTCFiltro'];
$response = $tipocasillaModel->obtenerTotalTipoCasillasRegistradas($descripcionTipoCasillas);

print json_encode($response);