<?php
require_once "../../models/usuario/Usuario.php";
require_once "../../config/database.php";

$idTipoUsuario = trim($_POST['idTipoUsuario']);
$Usuario = trim($_POST['Usuario']);
$Password= trim($_POST['Password']);
$idUsuario = trim($_POST['idUsuario']);
$idPersona = trim($_POST['idPersona']);
$usuarioModel = new Usuario();
$usuarioModel->setUsuario($Usuario);
$response=$usuarioModel->existeUsuario();

if ($response['message'] == 'Usuario encontrado') {
    print json_encode($response);
} else {
    $usuarioModel->setidPersona($idPersona);
    $usuarioModel->setidTipoUsuario($idTipoUsuario);
    $usuarioModel->setidUsuario($idUsuario);
    $usuarioModel->setUsuario($Usuario);
    $usuarioModel->setPassword($Password);
    $response = $usuarioModel->actualizarUsuario();
    print json_encode($response);
}

