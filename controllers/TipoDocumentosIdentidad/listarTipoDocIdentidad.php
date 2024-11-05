<?php
require_once "../../models/TipoDocumentoIdentidad.php";
require_once "../../config/database.php";

$tipodocumentoidentidadObj = new TipoDocumentoIdentidad();

$Descripcion=$_POST["descripcionTDIFiltro"];
$Pagina = $_POST['pagina'];
$RegistrosPorPagina = $_POST['registrosPorPagina'];
$tipodocumentoidentidadObj->setDescripcion($Descripcion);

$response = $tipodocumentoidentidadObj->listarTipoDocumentosIdentidadRegistrados($Descripcion);

if ($response > 0){
    $data = $response;
}else{
    $data = null;
}

print json_encode($data);