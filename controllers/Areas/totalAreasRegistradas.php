<?php
require_once "../../config/database.php";
require_once "../../models/Area.php";

$areaModel = new Area();
$descripcionArea=$_GET['descripcionAreaFiltro'];
$response = $areaModel->obtenerTotalAreasRegistradas($descripcionArea);

print json_encode($response);