<?php
require_once "../../models/TipoUsuarios.php";
require_once "../../config/database.php";

$descripcion = trim($_POST['descripcion']);

$tipoUsuarioModel = new TipoUsuarios();
$tipoUsuarioModel->setDescripcion($descripcion);

$response = $tipoUsuarioModel->existeTipoUsuario();

if ($response['message'] == 'Tipo Usuario encontrado') {
    print json_encode($response);
} else {
    $tipoUsuarioModel->setDescripcion($descripcion);
    $response = $tipoUsuarioModel->registrarTipoUsuario();
    print json_encode($response);
}

