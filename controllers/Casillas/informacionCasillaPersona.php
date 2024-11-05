<?php
require_once "../../models/Casilla.php";
require_once "../../config/database.php";

$casillaObj = new Casilla();

$usuario=$_POST["usuario"];
// $filtroBusqueda=$_POST["filtroBusqueda"];

// $Pagina = $_POST['pagina'];
// $RegistrosPorPagina = $_POST['registrosPorPagina'];
$response=$casillaObj->InformacionCasillaPersona($usuario);
if ($response > 0){
    $data = $response;
}else{
    $data = null;
}

print json_encode($data);