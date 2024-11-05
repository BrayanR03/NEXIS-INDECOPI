<?php
require_once "../../models/Persona.php";
require_once "../../config/database.php";

$personaObj = new Persona();

$datosBusquedaFiltro=$_POST["datosBusquedaFiltro"];
$filtroBusqueda=$_POST["filtroBusqueda"];
// if($datosBusquedaFiltro==='' || $filtroBusqueda===''){
//     print json_decode($data);
// }
$Pagina = $_POST['pagina'];
$RegistrosPorPagina = $_POST['registrosPorPagina'];
// if($datosBusquedaFiltro==='' && $filtroBusqueda==='nombres'){
//     $personaObj->setNombres($datosBusquedaFiltro);
//     // $response = $personaObj->ListarPersonasRegistradas($datosBusquedaFiltro,$filtroBusqueda);
if (!empty($datosBusquedaFiltro) && $filtroBusqueda === 'nombres') {
    // Separar nombre y apellido basados en espacios
    $nombresArray = explode(" ", $datosBusquedaFiltro);
    
    // Asumir que el primer elemento es el nombre y lo demás es el apellido
    $nombre = $nombresArray[0];
    $apellido = isset($nombresArray[1]) ? $nombresArray[1] : '';

    // Establecer nombre y apellido en el objeto Persona
    $personaObj->setNombres($nombre);
    $personaObj->setApellidos($apellido);

    // Realizar la búsqueda
    $response = $personaObj->ListarPersonasRegistradas($nombre, $apellido);

}
else if(!empty($datosBusquedaFiltro) && $filtroBusqueda==='Dni'){
    $personaObj->setTipoDocumentoIdentidad('1');
    $personaObj->setNumDocumentoIdentidad($datosBusquedaFiltro);
    $response = $personaObj->ListarPersonasRegistradas($datosBusquedaFiltro,$filtroBusqueda);
}
else if(!empty($datosBusquedaFiltro) && $filtroBusqueda==='Ruc'){
    $personaObj->setTipoDocumentoIdentidad('2');
    $personaObj->setNumDocumentoIdentidad($datosBusquedaFiltro);
    $response = $personaObj->ListarPersonasRegistradas($datosBusquedaFiltro,$filtroBusqueda);
}
else if(!empty($datosBusquedaFiltro) && $filtroBusqueda==='Pasaporte'){
    $personaObj->setTipoDocumentoIdentidad('3');
    $personaObj->setNumDocumentoIdentidad($datosBusquedaFiltro);
    $response = $personaObj->ListarPersonasRegistradas($datosBusquedaFiltro,$filtroBusqueda);
}
else{
    $response = $personaObj->ListarPersonasRegistradas($datosBusquedaFiltro,$filtroBusqueda);
}
// $personaObj->setNombres($datosBusquedaFiltro);
// $personaObj->setNumDocumentoIdentidad($filtroBusqueda);

if ($response > 0){
    $data = $response;
}else{
    $data = null;
}

print json_encode($data);