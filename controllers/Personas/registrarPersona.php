<?php
session_start();
require_once "../../models/Persona.php";
require_once "../../config/database.php";
date_default_timezone_set('America/Lima');

$razonSocial = trim($_POST['razonSocialPersonaNuevo']);
$nombres = trim($_POST['nombres']);
$apellidos = trim($_POST['apellidos']);
$dniCUI = trim($_POST['dniCUI']);
$email = trim($_POST['email']);
$telefono = trim($_POST['telefono']);
$domicilio = trim($_POST['domicilio']);
$tipoPersona = $_POST['tipoPersona'];
$tipoDocumentoIdentidad = $_POST['tipoDocumentoIdentidad'];
$numDocumentoIdentidad = trim($_POST['numDocumentoIdentidad']);
$representanteLegal = trim($_POST['representanteLegal']);

if ($tipoPersona == 1) {
    $razonSocial = null;
    $representanteLegal = null;

    $personaModel = new Persona();
    $personaModel->setNumDocumentoIdentidad($numDocumentoIdentidad);
    $response = $personaModel->existeNumDocIdentidad();

    if ($response['message'] == 'NumDoc encontrado') {
        print json_encode($response);
    } else {
        $personaModel->setNombres($nombres);
        $personaModel->setApellidos($apellidos);
        $personaModel->setDniCUI($dniCUI);
        $personaModel->setEmail($email);
        $personaModel->setTelefono($telefono);
        $personaModel->setDomicilio($domicilio);
        $personaModel->setTipoPersona($tipoPersona);
        $personaModel->setTipoDocumentoIdentidad($tipoDocumentoIdentidad);
        $personaModel->setNumDocumentoIdentidad($numDocumentoIdentidad);
        $personaModel->setRepresentanteLegal($representanteLegal);
        $response = $personaModel->registrarPersona();
        print json_encode($response);
    }
} else if ($tipoPersona == 2) {
    $dniCUI = null;
    $apellidos = null;
    $nombres = null;

    $personaModel = new Persona();  
    $personaModel->setNumDocumentoIdentidad($numDocumentoIdentidad);
    $response = $personaModel->existeNumDocIdentidad();

    if ($response['message'] == 'NumDoc encontrado') {
        print json_encode($response);
    } else {
        $personaModel->setNombres($razonSocial);
        $personaModel->setApellidos($apellidos);
        $personaModel->setDniCUI($dniCUI);
        $personaModel->setEmail($email);
        $personaModel->setTelefono($telefono);
        $personaModel->setDomicilio($domicilio);
        $personaModel->setTipoPersona($tipoPersona);
        $personaModel->setTipoDocumentoIdentidad($tipoDocumentoIdentidad);
        $personaModel->setNumDocumentoIdentidad($numDocumentoIdentidad);
        $personaModel->setRepresentanteLegal($representanteLegal);
        $response = $personaModel->registrarPersona();
        print json_encode($response);
    }
}
