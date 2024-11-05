<?php
require_once "../../models/Area.php";
require_once "../../config/database.php";

$codArea = trim($_POST['codArea']);
$area = trim($_POST['descripcion']);
$estadoarea = $_POST['estado'];


$areaModel = new Area();
$areaModel->setEstado($estadoarea);


$areaModel->setidArea($codArea);
$areaModel->setDescripcion($area);
$areaModel->setEstado($estadoarea);
$response = $areaModel->actualizarEstadoArea();
print json_encode($response);

// $response = $areaModel->existeArea();

// if ($response['message'] == 'Area encontrada'){
//     print json_encode($response);
// }else{
    
// }