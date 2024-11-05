<?php

require_once "../../models/Movimiento.php";
require_once "../../config/database.php";

// Verifica que la acción sea de descarga y que el idMovimiento esté presente
if (isset($_GET['action']) && $_GET['action'] === 'descargarDocumento' && isset($_GET['id'])) {
    $idMovimiento = $_GET['id'];

    // Obtener el archivo y la extensión desde la base de datos
    $movimientoModel = new Movimiento();
    $archivoData = $movimientoModel->obtenerDocumentoBinario($idMovimiento);

    if ($archivoData) {
        // Descomponer el archivo binario y la extensión
        $contenidoBinario = $archivoData['ArchivoDocumento'];
        $extension = $archivoData['ExtensionDocumento'];
        $nombreArchivo = "$extension";

        // Configurar las cabeceras para la descarga
        header("Content-Description: File Transfer");
        header("Content-Type: application/octet-stream");
        header("Content-Disposition: attachment; filename=\"$nombreArchivo\"");
        header("Content-Transfer-Encoding: binary");
        header("Expires: 0");
        header("Cache-Control: must-revalidate");
        header("Pragma: public");
        header("Content-Length: " . strlen($contenidoBinario));

        // Enviar el contenido binario al navegador
        echo $contenidoBinario;
        exit;
    } else {
        echo "No se pudo encontrar el documento.";
    }
} else {
    echo "Solicitud inválida.";
}

