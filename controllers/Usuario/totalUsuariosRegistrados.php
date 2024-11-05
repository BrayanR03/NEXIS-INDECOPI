<?php
require_once "../../config/database.php";
require_once "../../models/usuario/Usuario.php";

$usuarioModel = new Usuario();
$datosBusquedaFiltro = $_GET['datosBusquedaFiltro'];
$filtroBusqueda = $_GET['filtroBusqueda'];
if (!empty($datosBusquedaFiltro) && $filtroBusqueda === 'usuariosAll') {

    $response = $usuarioModel->listadoTotalUsuarios($datosBusquedaFiltro, $filtroBusqueda);
} else if (!empty($datosBusquedaFiltro) && $filtroBusqueda === 'sinUsuario') {
    $response = $usuarioModel->listadoTotalUsuarios($datosBusquedaFiltro, $filtroBusqueda);
} else if (!empty($datosBusquedaFiltro) && $filtroBusqueda === 'conUsuario') {

    $response = $usuarioModel->listadoTotalUsuarios($datosBusquedaFiltro, $filtroBusqueda);
}
else{
    $response = $usuarioModel->listadoTotalUsuarios($datosBusquedaFiltro, $filtroBusqueda);

}
if ($response > 0) {
    $data = $response;
} else {
    $data = null;
}
print json_encode($data);
