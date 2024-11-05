<?php
require_once "../../config/database.php";
require_once "../../models/Casilla.php";

$casillaModel = new Casilla();
$datosBusquedaFiltro = $_GET['datosBusquedaFiltro'];
$filtroBusqueda = $_GET['filtroBusqueda'];
if (!empty($datosBusquedaFiltro) && $filtroBusqueda === 'usuariosAll') {

    $response = $casillaModel->ListadoTotalUsuariosCasillas($datosBusquedaFiltro, $filtroBusqueda);
} else if (!empty($datosBusquedaFiltro) && $filtroBusqueda === 'sinCasilla') {
    $response = $casillaModel->ListadoTotalUsuariosCasillas($datosBusquedaFiltro, $filtroBusqueda);
} else if (!empty($datosBusquedaFiltro) && $filtroBusqueda === 'conCasilla') {

    $response = $casillaModel->ListadoTotalUsuariosCasillas($datosBusquedaFiltro, $filtroBusqueda);
}
else{
    $response = $casillaModel->ListadoTotalUsuariosCasillas($datosBusquedaFiltro, $filtroBusqueda);

}
if ($response > 0) {
    $data = $response;
} else {
    $data = null;
}
print json_encode($data);
