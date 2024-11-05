<?php
session_start();
require_once "../../models/Casilla.php";
require_once "../../config/database.php";
date_default_timezone_set('America/Lima');

$idPersona = trim($_POST['idPersonaAsignar']);
$idTipoCasilla = trim($_POST['idTipoCasilla']);
$fechaApertura = trim($_POST['fechaApertura']);

$casillaModel = new Casilla();
$casillaModel->setidPersona($idPersona);
$casillaModel->setidTipocasilla($idTipoCasilla);
$casillaModel->setFechaApertura($fechaApertura);
$response = $casillaModel->registrarCasillaPersona();
print json_encode($response);
