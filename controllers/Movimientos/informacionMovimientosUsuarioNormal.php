<?php
require_once "../../models/Movimiento.php";
require_once "../../config/database.php";

$movimientoObj = new Movimiento();
$idCasilla = $_POST["idCasilla"];

$response = $movimientoObj->listarNotificacionesUsuarioNormal($idCasilla);

if ($response > 0) {
    $data = $response;
} else {
    $data = null;
}

print json_encode($data);
