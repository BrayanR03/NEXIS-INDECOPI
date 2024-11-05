<?php
require_once "../../models/usuario/Usuario.php";
require_once "../../config/database.php";

$usuarioObj = new Usuario();

$usuario = $_POST["usuario"];
$response = $usuarioObj->informacionPerfilUsuario($usuario);

if ($response > 0) {
    $data = $response;
} else {
    $data = null;
}

print json_encode($data);
