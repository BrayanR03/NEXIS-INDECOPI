<?php
require_once "../../models/usuario/Usuario.php";
require_once "../../config/database.php";

$usuarioObj = new Usuario();

$datosBusquedaFiltro=$_POST["datosBusquedaFiltro"];
$filtroBusqueda=$_POST["filtroBusqueda"];

$Pagina = $_POST['pagina'];
$RegistrosPorPagina = $_POST['registrosPorPagina'];

if (!empty($datosBusquedaFiltro) && $filtroBusqueda === 'usuariosAll') {
    // Separar nombre y apellido basados en espacios
    $nombresArray = explode(" ", $datosBusquedaFiltro);
    $response = $usuarioObj->listadoUsuarios($datosBusquedaFiltro, $filtroBusqueda);
}
else if(!empty($datosBusquedaFiltro) && $filtroBusqueda==='sinUsuario'){
    $response = $usuarioObj->listadoUsuarios($datosBusquedaFiltro,$filtroBusqueda);
}
else if(!empty($datosBusquedaFiltro) && $filtroBusqueda==='conUsuario'){
    $response = $usuarioObj->listadoUsuarios($datosBusquedaFiltro,$filtroBusqueda);
}
else{
    $response = $usuarioObj->listadoUsuarios($datosBusquedaFiltro,$filtroBusqueda);
}

if ($response > 0){
    $data = $response;
}else{
    $data = null;
}

print json_encode($data);