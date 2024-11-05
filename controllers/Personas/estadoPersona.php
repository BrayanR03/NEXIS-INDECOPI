<?php
require_once "../../models/Persona.php";
require_once "../../config/database.php";

$idUsuario = trim($_POST['idPersona']);
$nombres = trim($_POST['nombres']);
$estadousuario = $_POST['estado'];

$personaModel = new Persona();
$personaModel->setidPersona($idUsuario);
$personaModel->setEstado($estadousuario);
$response = $personaModel->estadoActualizarPersona();
print json_encode($response);

// $response = $areaModel->existeArea();

// if ($response['message'] == 'Area encontrada'){
//     print json_encode($response);
// }else{
    
// }