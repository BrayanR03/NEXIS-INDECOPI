<?php
require_once "../../models/TipoCasilla.php";
require_once "../../config/database.php";

$descripcion = trim($_POST['descripcion']);

$tipoCasillaModel = new TipoCasilla();
$tipoCasillaModel->setDescripcion($descripcion);

$response = $tipoCasillaModel->existeTipoCasilla();

if ($response['message'] == 'Tipo Casilla encontrado') {
    print json_encode($response);
} else {
    $tipoCasillaModel->setDescripcion($descripcion);
    $response = $tipoCasillaModel->registrarTipoCasilla();
    print json_encode($response);
}

