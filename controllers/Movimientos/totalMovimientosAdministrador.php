<?php
require_once "../../config/database.php";
require_once "../../models/Movimiento.php";

$movimientoModel = new Movimiento();
$idUsuario = $_GET["idUsuario"];
$datosBusquedaFiltroNotificaciones=$_GET['datosBusquedaFiltroNotificaciones'];
$response = $movimientoModel->totalNotificacionesCasillaAdministrador($idUsuario,$datosBusquedaFiltroNotificaciones);
if ($response > 0) {
    $data = $response;
} else {
    $data = null;
}
print json_encode($data);
