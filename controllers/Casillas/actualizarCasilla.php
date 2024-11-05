<?php
require_once "../../models/Casilla.php";
require_once "../../config/database.php";

$idTipoCasilla = trim($_POST['idTipoCasilla']);
$idPersona = trim($_POST['idPersona']);
$FechaApertura = trim($_POST['FechaApertura']);
$Estado = trim($_POST['estado']);
$idCasilla = trim($_POST['idCasilla']);

$casillaModel = new Casilla();
$casillaModel->setidPersona($idPersona);
$casillaModel->setidTipocasilla($idTipoCasilla);
$casillaModel->setFechaApertura($FechaApertura);
$casillaModel->setEstado($Estado);
$casillaModel->setidCasilla($idCasilla);
$response = $casillaModel->actualizarDatosCasilla();
print json_encode($response);
