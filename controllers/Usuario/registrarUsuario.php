<?php
session_start();
require_once "../../models/usuario/Usuario.php";
require_once '../../models/usuario/EnviarCorreoUsuario.php';
require_once "../../config/database.php";
date_default_timezone_set('America/Lima');

$idPersona = trim($_POST['idPersonaRegister']);
$tipoUsuario=trim($_POST['tipoUsuarioRegister']);
$usuario= trim($_POST['usuarioRegister']);
$password= trim($_POST['passwordRegister']);
$correo=trim($_POST['emailPersonaUsuario']);

$usuarioModel = new Usuario();
$enviarCorreo=new EnviarCorreoUsuario();
$usuarioModel->setUsuario($usuario);
$response= $usuarioModel->existeUsuario();
if ($response['message'] == 'Usuario encontrado') {
    print json_encode($response);
} else {
    $usuarioModel->setidPersona($idPersona);
    $usuarioModel->setidTipoUsuario($tipoUsuario);
    $usuarioModel->setUsuario($usuario);
    $usuarioModel->setPassword($password);
    $response = $usuarioModel->RegistrarUsuario();
    $enviarCorreo->enviar($correo,$usuario,$password);
    print json_encode($response);
}

