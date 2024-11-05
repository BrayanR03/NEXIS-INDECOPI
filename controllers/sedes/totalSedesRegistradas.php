<?php
require_once "../../config/database.php";
require_once "../../models/Sede.php";

$sedeModel = new Sede();
$descripcionSede=$_GET['descripcionSedeFiltro'];
$response = $sedeModel->obtenerTotalSedesRegistradas($descripcionSede);

print json_encode($response);