<?php
require_once "../../models/TipoUsuarios.php";
require_once "../../config/database.php";

$idTipoUsuario = trim($_POST['idTipoUsuario']);
$descripcion = trim($_POST['descripcion']);
$estado = trim($_POST['estado']);


$tipoUsuarioModel = new TipoUsuarios();
$tipoUsuarioModel->setDescripcion($descripcion);
$tipoUsuarioModel->setEstado($estado);
$tipoUsuarioModel->setidTipoUsuario($idTipoUsuario);
$response = $tipoUsuarioModel->actualizarTipoUsuario();
print json_encode($response);
