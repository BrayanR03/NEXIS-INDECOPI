<?php
require_once "../../config/database.php";
require_once "../../models/Sede.php";

$sedeModel = new Sede();

$response = $sedeModel->ListarSedeCombo();

print json_encode($response);