<?php
require_once "../../models/usuario/Usuario.php";
require_once "../../config/database.php";

$idUsuario = trim($_POST['idUsuario']);
$estadousuario = $_POST['estado'];
// echo $estadopersona;
// print_r($estadopersona);
$usuarioModel = new Usuario();
$usuarioModel->setidUsuario($idUsuario);
$usuarioModel->setEstado($estadousuario);
$response = $usuarioModel->estadoActualizarUsuario();
print json_encode($response);

// $response = $areaModel->existeArea();

// if ($response['message'] == 'Area encontrada'){
//     print json_encode($response);
// }else{
    
// }