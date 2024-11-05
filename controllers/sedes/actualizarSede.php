<?php
require_once "../../models/Sede.php";
require_once "../../config/database.php";

$idSede = trim($_POST['idSede']);
$sede = trim($_POST['descripcion']);
$estado = trim($_POST['estado']);


$sedeModel = new Sede();

$sedeModel->setidSede($idSede);
$sedeModel->setDescripcion($sede);
$sedeModel->setEstado($estado);
$response = $sedeModel->actualizarSede();
print json_encode($response);
