<?php
require_once "../../models/Movimiento.php";
require_once "../../config/database.php";

$movimientoObj = new Movimiento();
$idCasilla = $_POST["idCasilla"];
$idMovimiento = $_POST["idMovimiento"];

$response = $movimientoObj->reporteNotificacionUsuarioNormal($idCasilla,$idMovimiento);

if ($response > 0) {
    $data = $response;
} else {
    $data = null;
}

print json_encode($data);
