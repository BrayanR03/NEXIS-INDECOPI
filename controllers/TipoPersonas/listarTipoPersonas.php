<?php
require_once "../../models/TipoPersonas.php";
require_once "../../config/database.php";

$tipoPersonasObj = new TipoPersonas();

$Descripcion=$_POST["descripcionTPFiltro"];
$Pagina = $_POST['pagina'];
$RegistrosPorPagina = $_POST['registrosPorPagina'];
$tipoPersonasObj->setDescripcion($Descripcion);

$response = $tipoPersonasObj->listarTipoPersonasRegistradas($Descripcion);

if ($response > 0){
    $data = $response;
}else{
    $data = null;
}

print json_encode($data);