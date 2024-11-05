<?php
require_once "../../models/TipoCasilla.php";
require_once "../../config/database.php";

$tipocasillaObj = new TipoCasilla();

$Descripcion=$_POST["descripcionTCFiltro"];
$Pagina = $_POST['pagina'];
$RegistrosPorPagina = $_POST['registrosPorPagina'];
$tipocasillaObj->setDescripcion($Descripcion);
$response = $tipocasillaObj->listarTipoCasillasRegistrados($Descripcion);

if ($response > 0){
    $data = $response;
}else{
    $data = null;
}

print json_encode($data);