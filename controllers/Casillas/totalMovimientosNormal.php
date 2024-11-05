<?php
require_once "../../config/database.php";
require_once "../../models/Movimiento.php";

$movimientoModel = new Movimiento();
$idCasilla = $_GET["idCasilla"];
$response = $movimientoModel->totalNotificacionesUsuarioNormal($idCasilla);
if ($response > 0) {
    $data = $response;
} else {
    $data = null;
}
print json_encode($data);
