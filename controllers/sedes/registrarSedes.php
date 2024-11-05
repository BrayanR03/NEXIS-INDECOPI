<?php
require_once "../../models/Sede.php";
require_once "../../config/database.php";

$sede = trim($_POST['descripcion']);

$sedeModel = new Sede();
$sedeModel->setDescripcion($sede);

$response = $sedeModel->existeSede();

if ($response['message'] == 'Sede encontrada') {
    print json_encode($response);
} else {
    $sedeModel->setDescripcion($sede);
    $response = $sedeModel->registrarSede();
    print json_encode($response);
}

