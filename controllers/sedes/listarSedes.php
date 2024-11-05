<?php
require_once "../../models/Sede.php";
require_once "../../config/database.php";

$sedeObj = new Sede();

$Descripcion=$_POST["descripcionSedeFiltro"];
$Pagina = $_POST['pagina'];
$RegistrosPorPagina = $_POST['registrosPorPagina'];
$sedeObj->setDescripcion($Descripcion);

$response = $sedeObj->ListarSedesRegistradas($Descripcion);

if ($response > 0){
    $data = $response;
}else{
    $data = null;
}

print json_encode($data);