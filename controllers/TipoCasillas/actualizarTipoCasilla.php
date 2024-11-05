<?php
require_once "../../models/TipoCasilla.php";
require_once "../../config/database.php";

$idTipoCasilla = trim($_POST['idTipoCasilla']);
$descripcion = trim($_POST['descripcion']);
$estado = trim($_POST['estado']);


$tipoCasillaModel = new TipoCasilla();
$tipoCasillaModel->setDescripcion($descripcion);
$tipoCasillaModel->setEstado($estado);
$tipoCasillaModel->setidTipoCasilla($idTipoCasilla);
$response = $tipoCasillaModel->actualizarTipoCasilla();
print json_encode($response);
