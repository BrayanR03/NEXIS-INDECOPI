<?php
require_once "../../models/Movimiento.php";
require_once "../../config/database.php";

class MovimientoController {
    private $movimientoModel;

    public function __construct() {
        $this->movimientoModel = new Movimiento();
    }

    public function descargarArchivo($idMovimiento) {
        try {
            $archivo = $this->movimientoModel->obtenerDocumentoBinario($idMovimiento);

            if ($archivo) {
                $contenidoBinario = hex2bin(substr($archivo['ArchivoDocumento'], 2));  // Convierte de hex a binario
                $extension = $archivo['ExtensionDocumento'];
                $nombreArchivo = $archivo['NroDocumento'] . '.' . $extension;

                // Configura las cabeceras para la descarga
                header("Content-Type: application/octet-stream");
                header("Content-Disposition: attachment; filename=\"$extension\"");
                header("Content-Length: " . strlen($contenidoBinario));

                // Muestra el contenido binario para la descarga
                // echo $contenidoBinario;
                exit;
            }
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }
}
