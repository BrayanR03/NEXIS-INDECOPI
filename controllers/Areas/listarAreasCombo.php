<?php
require_once "../../config/database.php";
require_once "../../models/Area.php";

$areaModel = new Area();

$response = $areaModel->ListarAreasCombo();

print json_encode($response);