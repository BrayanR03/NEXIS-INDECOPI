<?php
// echo getcwd();
require_once "../models/usuario/Usuario.php";
require_once "../config/database.php";


$usuario = $_POST["user"];
$password = $_POST["password"];

$usuarioModel = new Usuario();
$usuarioModel->setUsuario($usuario);
$usuarioModel->setPassword($password);

$response = $usuarioModel->AutenticacionUsuario();
// var_dump($response);
// die();
print json_encode($response);