<?php
session_start();
require_once "../config/parameters.php";

$idUsuario=$_POST['data'][0]['idUsuario'];
$usuario=$_POST['data'][0]['Usuario'];
$tipousuario=$_POST['data'][0]['TipoUsuario'];
$persona=$_POST['data'][0]['Persona'];
$tipopersona=$_POST['data'][0]['TipoPersona'];
$idCasilla=$_POST['data'][0]['idCasilla'];


$_SESSION['idUsuario']=$idUsuario;
$_SESSION['Usuario'] = $usuario;
$_SESSION['TipoUsuario'] = $tipousuario;
$_SESSION['Persona'] = $persona;
$_SESSION['TipoPersona'] = $tipopersona;
$_SESSION['idCasilla'] = $idCasilla;
$_SESSION['autenticado'] = true;
// $_SESSION['Usuario'] = $_POST['data'];
// $_SESSION['autenticado'] = true;
$_SESSION['base_url'] = base_url;

$response = (isset($_SESSION['idUsuario'],$_SESSION['Usuario'], $_SESSION['Persona'], $_SESSION['TipoUsuario'], 
             $_SESSION['TipoPersona'], $_SESSION['idCasilla'], $_SESSION['autenticado']) && 
             !empty($_SESSION['idUsuario']) && !empty($_SESSION['Usuario']) && !empty($_SESSION['Persona'])
             && !empty($_SESSION['TipoPersona']) && !empty($_SESSION['TipoUsuario']) && !empty($_SESSION['idCasilla']) && $_SESSION['autenticado'] === true);

print json_encode($response);
// print json_encode([$usuario,$persona,$tipousuario,$tipopersona]);
