<?php
require_once "../../models/Area.php";
require_once "../../config/database.php";

$codArea = trim($_POST['codArea']);
$area = trim($_POST['descripcion']);
$estado = trim($_POST['estado']);


$areaModel = new Area();
$areaModel->setidArea($codArea);
$areaModel->setDescripcion($area);
$areaModel->setEstado($estado);
$response = $areaModel->actualizarArea();
print json_encode($response);
