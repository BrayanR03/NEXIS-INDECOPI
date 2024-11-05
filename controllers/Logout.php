<?php
session_start();
$_SESSION['idUsuario'] = false;
$_SESSION['Usuario'] = false;
$_SESSION['TipoUsuario'] = false;
$_SESSION['Persona'] = false;
$_SESSION['TipoPersona'] = false;
$_SESSION['autenticado'] = false;
unset($_SESSION['autenticado']);
unset($_SESSION['idUsuario']);
unset($_SESSION['Usuario']);
unset($_SESSION['TipoUsuario']);
unset($_SESSION['Persona']);
unset($_SESSION['TipoPersona']);

$response = !(isset($_SESSION['idUsuario'],$_SESSION['Usuario'], $_SESSION['Persona'], $_SESSION['TipoUsuario'], 
             $_SESSION['TipoPersona'], $_SESSION['autenticado']) && 
             !empty($_SESSION['idUsuario']) && !empty($_SESSION['Usuario']) && !empty($_SESSION['Persona'])
             && !empty($_SESSION['TipoPersona']) && !empty($_SESSION['TipoUsuario']) && $_SESSION['autenticado'] === true);

print json_encode($response);