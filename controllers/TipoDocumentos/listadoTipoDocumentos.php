<?php
require_once "../../models/TipoDocumento.php";
require_once "../../config/database.php";

$tipodocumentoObj = new TipoDocumento();

$Descripcion=$_POST["descripcionTDFiltro"];
$Pagina = $_POST['pagina'];
$RegistrosPorPagina = $_POST['registrosPorPagina'];
$tipodocumentoObj->setDescripcion($Descripcion);

$response = $tipodocumentoObj->listarTipoDocumentosRegistrados($Descripcion);

if ($response > 0){
    $data = $response;
}else{
    $data = null;
}

print json_encode($data);