<?php
require_once "../../config/database.php";
require_once "../../models/TipoUsuarios.php";

$tipoUsuariosModel = new TipoUsuarios();

$response = $tipoUsuariosModel->listarTipoUsuariosCombo();

print json_encode($response);