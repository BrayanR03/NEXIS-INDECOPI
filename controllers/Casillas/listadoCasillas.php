<?php
require_once "../../models/Casilla.php";
require_once "../../config/database.php";

$casillaObj = new Casilla();

$datosBusquedaFiltro=$_POST["datosBusquedaFiltro"];
$filtroBusqueda=$_POST["filtroBusqueda"];

$Pagina = $_POST['pagina'];
$RegistrosPorPagina = $_POST['registrosPorPagina'];

if (!empty($datosBusquedaFiltro) && $filtroBusqueda === 'usuariosAll') {
    // Separar nombre y apellido basados en espacios
    $nombresArray = explode(" ", $datosBusquedaFiltro);
    $response = $casillaObj->ListadoUsuariosCasillas($datosBusquedaFiltro, $filtroBusqueda);
}
else if(!empty($datosBusquedaFiltro) && $filtroBusqueda==='sinCasilla'){
    $response = $casillaObj->ListadoUsuariosCasillas($datosBusquedaFiltro,$filtroBusqueda);
}
else if(!empty($datosBusquedaFiltro) && $filtroBusqueda==='conCasilla'){
    $response = $casillaObj->ListadoUsuariosCasillas($datosBusquedaFiltro,$filtroBusqueda);
}
else{
    $response = $casillaObj->ListadoUsuariosCasillas($datosBusquedaFiltro,$filtroBusqueda);
}

if ($response > 0){
    $data = $response;
}else{
    $data = null;
}

print json_encode($data);