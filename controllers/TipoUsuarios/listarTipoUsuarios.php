<?php
require_once "../../models/TipoUsuarios.php";
require_once "../../config/database.php";

$tipousuariosObj = new TipoUsuarios();

$Descripcion=$_POST["descripcionTUFiltro"];
$Pagina = $_POST['pagina'];
$RegistrosPorPagina = $_POST['registrosPorPagina'];
$tipousuariosObj->setDescripcion($Descripcion);

$response = $tipousuariosObj->listarTipoUsuariosRegistrados($Descripcion);

if ($response > 0){
    $data = $response;
}else{
    $data = null;
}

print json_encode($data);