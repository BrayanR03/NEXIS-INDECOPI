<?php
require_once "../../config/database.php";
require_once "../../models/Persona.php";

$personaModel = new Persona();
$datosBusquedaFiltro = $_GET['datosBusquedaFiltro'];
$filtroBusqueda = $_GET['filtroBusqueda'];
if (!empty($datosBusquedaFiltro) && $filtroBusqueda === 'nombres') {

    $response = $personaModel->obtenerTotalPersonasRegistradas($datosBusquedaFiltro, $filtroBusqueda);
} else if (!empty($datosBusquedaFiltro) && $filtroBusqueda === 'Dni') {
    $response = $personaModel->obtenerTotalPersonasRegistradas($datosBusquedaFiltro, $filtroBusqueda);
} else if (!empty($datosBusquedaFiltro) && $filtroBusqueda === 'Ruc') {

    $response = $personaModel->obtenerTotalPersonasRegistradas($datosBusquedaFiltro, $filtroBusqueda);
} else if (!empty($datosBusquedaFiltro) && $filtroBusqueda === 'Pasaporte') {

    $response = $personaModel->obtenerTotalPersonasRegistradas($datosBusquedaFiltro, $filtroBusqueda);
}
else{
    $response = $personaModel->obtenerTotalPersonasRegistradas($datosBusquedaFiltro, $filtroBusqueda);

}
if ($response > 0) {
    $data = $response;
} else {
    $data = null;
}
print json_encode($data);
