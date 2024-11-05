<?php
require_once "../../config/database.php";
require_once "../../models/Casilla.php";

$casillaModel = new Casilla();

$response = $casillaModel->idUltimaCasilla();
if ($response > 0) {
    $data = $response;
} else {
    $data = null;
}
print json_encode($data);