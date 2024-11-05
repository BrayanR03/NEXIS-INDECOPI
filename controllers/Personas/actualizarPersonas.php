<?php
require_once "../../models/Persona.php";
require_once "../../config/database.php";

// print_r($_POST);
$idPersona = trim($_POST['idPersona']);
$nombres = trim($_POST['nombres']);
$apellidos = trim($_POST['apellidos']);
$email = trim($_POST['email']);
$telefono = trim($_POST['telefono']);
$domicilio = trim($_POST['domicilio']);
$tipoPersona = $_POST['tipoPersona'];
$tipoDocumentoIdentidad = $_POST['tipoDocumentoIdentidad'];
$numDocumentoIdentidad = trim($_POST['numDocumentoIdentidad']);
$dniCUI = trim($_POST['dniCUI']);
$estado = trim($_POST['estadoPersonaEditar']);
$representanteLegal = trim($_POST['representanteLegal']);


$personaModel = new Persona();
$personaModel->setNombres($nombres);
$personaModel->setApellidos($apellidos);
$personaModel->setEmail($email);
$personaModel->setTelefono($telefono);
$personaModel->setDomicilio($domicilio);
$personaModel->setTipoPersona($tipoPersona);
$personaModel->setTipoDocumentoIdentidad($tipoDocumentoIdentidad);
$personaModel->setNumDocumentoIdentidad($numDocumentoIdentidad);
$personaModel->setDniCUI($dniCUI);
$personaModel->setEstado($estado);
$personaModel->setRepresentanteLegal($representanteLegal);
$personaModel->setidPersona($idPersona);
$response = $personaModel->actualizarPersona();
print json_encode($response);
// $response = $areaModel->existeArea();

// if ($response['message'] == 'Area encontrada'){
//     print json_encode($response);
// }else{
//     $areaModel->setidArea($codArea);
//     $areaModel->setDescripcion($area);
//     $response = $areaModel->actualizarArea();
//     print json_encode($response);
// }