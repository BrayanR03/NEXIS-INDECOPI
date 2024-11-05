<?php
require_once "../../models/Area.php";
require_once "../../config/database.php";

$area = trim($_POST['descripcion']);

$areaModel = new Area();
$areaModel->setDescripcion($area);

$response = $areaModel->existeArea();

if ($response['message'] == 'Area encontrada') {
    print json_encode($response);
} else {
    $areaModel->setDescripcion($area);
    $response = $areaModel->registrarArea();
    print json_encode($response);
}

