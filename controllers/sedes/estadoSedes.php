<?php
require_once "../../models/Sede.php";
require_once "../../config/database.php";

$idSede = trim($_POST['idSede']);
$sede = trim($_POST['descripcion']);
$estadosede = $_POST['estado'];


$sedeModel = new Sede();
$sedeModel->setEstado($estadosede);


$sedeModel->setidSede($idSede);
$sedeModel->setDescripcion($sede);
$sedeModel->setEstado($estadosede);
$response = $sedeModel->actualizarEstadoSede();
print json_encode($response);

// $response = $areaModel->existeArea();

// if ($response['message'] == 'Area encontrada'){
//     print json_encode($response);
// }else{
    
// }