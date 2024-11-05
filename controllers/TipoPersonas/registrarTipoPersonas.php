<?php
require_once "../../models/TipoPersonas.php";
require_once "../../config/database.php";

$descripcion = trim($_POST['descripcion']);

$tipoPersonasModel = new TipoPersonas();
$tipoPersonasModel->setDescripcion($descripcion);

$response = $tipoPersonasModel->existeTipoPersona();

if ($response['message'] == 'Tipo Persona encontrado') {
    print json_encode($response);
} else {
    $tipoPersonasModel->setDescripcion($descripcion);
    $response = $tipoPersonasModel->registrarTipoPersona();
    print json_encode($response);
}

