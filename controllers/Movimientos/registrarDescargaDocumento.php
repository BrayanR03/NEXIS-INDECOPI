<?php
require_once "../../models/Movimiento.php";
require_once "../../config/database.php";

$idMovimiento = trim($_POST['idMovimiento']);
$movimientoModel=new Movimiento();
$response=$movimientoModel->registrarDescargaDocumento($idMovimiento);
print json_encode($response);
