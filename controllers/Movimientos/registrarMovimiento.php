<?php
// session_start();
require_once "../../models/Movimiento.php";
require_once "../../config/database.php";
require_once '../../models/usuario/EnviarCorreoUsuario.php';


// Depuración para ver si 'nroCasilla' está en $_POST
// echo "<pre>";
// print_r($_POST); // Para ver los datos enviados en el cuerpo de la solicitud
// echo "</pre>";
// die();  // Detener el script para ver el resultado antes de hacer cualquier otra cosa

// echo "<pre>";
// print_r($_FILES);
// echo "</pre>";

$nroCasilla = trim($_POST['nroCasilla']);
$tipoDocumento = $_POST['tipoDocumento'];
$nroDocumento = rtrim($_POST['nroDocumento']);
$fechaDocumento = $_POST['fechaDocumento'];
$fechaNotificacion = $_POST['fechaNotificacion'];
// $archivoDocumento = $_POST['archivoDocumento'];
$sumilla = trim($_POST['sumilla']);
$areaNotificacion = $_POST['areaNotificacion'];
$sedeNotificacion = $_POST['sedeNotificacion'];
$idUsuario = $_POST['usuarioRegistrador'];
$emailDestino= trim($_POST['emailDestino']);
// // Manejar el archivo subido
// if (isset($_FILES['archivoDocumento']) && $_FILES['archivoDocumento']['error'] === UPLOAD_ERR_OK) {
//     // Obtener información del archivo
//     $archivoNombre = $_FILES['archivoDocumento']['name'];
//     $archivoTipo = $_FILES['archivoDocumento']['type'];
//     $archivoTamaño = $_FILES['archivoDocumento']['size'];
//     $archivoTmpName = $_FILES['archivoDocumento']['tmp_name'];

//     // Leer el archivo en binario (si se va a guardar en la base de datos)
//     $archivoContenido = file_get_contents($archivoTmpName);

//     // Aquí puedes guardar el archivo en el sistema de archivos o en la base de datos (como VARBINARY en SQL Server)
// } else {
//     // Manejar el caso donde no se subió ningún archivo o ocurrió un error
//     $archivoContenido = null;
// }

// Manejar el archivo subido
// if (isset($_FILES['archivoDocumento']) && $_FILES['archivoDocumento']['error'] === UPLOAD_ERR_OK) {
//     // Obtener información del archivo
//     $archivoNombre = $_FILES['archivoDocumento']['name'];
//     $archivoTipo = $_FILES['archivoDocumento']['type'];
//     $archivoTamaño = $_FILES['archivoDocumento']['size'];
//     $archivoTmpName = $_FILES['archivoDocumento']['tmp_name'];

//     // Leer el archivo en binario
//     $archivoContenido = file_get_contents($archivoTmpName);

//     // Extraer la extensión del archivo
//     $archivoExtension = pathinfo($archivoNombre, PATHINFO_EXTENSION);
// } else {
//     // Si no hay archivo o ocurre un error
//     $archivoContenido = null;
//     $archivoExtension = null;
// }

// Suponiendo que recibes el archivo desde un formulario
// if (isset($_FILES['archivoDocumento']) && $_FILES['archivoDocumento']['error'] == UPLOAD_ERR_OK) {
//     // Obtener la extensión del archivo
//     $archivoExtension = pathinfo($_FILES['archivoDocumento']['name'], PATHINFO_EXTENSION);
    
//     // Abrir el archivo y obtener su contenido
//     $archivoContenido = fopen($_FILES['archivoDocumento']['tmp_name'], 'rb'); // 'rb' para lectura binaria
// } else {
//     $archivoContenido = null; // Manejar el error de carga según sea necesario
//     $archivoExtension = null;
// }

$movimientoModel = new Movimiento();
$enviarCorreo=new EnviarCorreoUsuario();
$movimientoModel->setCasilla($nroCasilla);
$movimientoModel->setNroDocumento($nroDocumento);

$movimientoModel->setTipoDocumento($tipoDocumento);
$movimientoModel->setFechaDocumento($fechaDocumento);
$movimientoModel->setFechaNotificacion($fechaNotificacion);
$movimientoModel->setSumilla($sumilla);
$movimientoModel->setArea($areaNotificacion);
$movimientoModel->setSede($sedeNotificacion);
$movimientoModel->setUsuario($idUsuario);
if (isset($_FILES['archivoDocumento']) && $_FILES['archivoDocumento']['error'] == UPLOAD_ERR_OK) {
    $carpetaDestino='../../uploads/';
    $archivoExtension = pathinfo($_FILES['archivoDocumento']['name'], PATHINFO_BASENAME);
    // $archivoContenido = $_FILES['archivoDocumento']['tmp_name']; // 'rb' para lectura binaria
    
    
    // Leer el contenido del archivo
    // $contenidoCompleto = stream_get_contents($archivoContenido);
    // fclose($archivoContenido); // Cerrar el recurso después de leer
    $archivoContenido = fopen($_FILES['archivoDocumento']['tmp_name'], 'rb'); // 'rb' para lectura binaria
    
    // if ($archivoContenido === false) {
    //     // Manejar el error al abrir el archivo
    //     throw new Exception("Error al abrir el archivo.");
    // }
    // $contenidoCompleto = stream_get_contents($archivoContenido);
    // $archivoHex = bin2hex($contenidoCompleto); // Convertir a hexadecimal
    $contenidoCompleto = stream_get_contents($archivoContenido);
    fclose($archivoContenido);
    $contenidoHexadecimal = bin2hex($contenidoCompleto);
    $contenidoHexadecimalSQL = "0x" . $contenidoHexadecimal;


    // var_dump($contenidoHexadecimalSQL);
    // die();
    // echo $archivoContenido;
    // Ahora puedes asignar el contenido a tu modelo
    $movimientoModel->setArchivoDocumento($contenidoHexadecimalSQL);
    $movimientoModel->setExtensionDocumento($archivoExtension);
    $archivoNombre=basename($_FILES['archivoDocumento']['name']);
    $rutaDestino=$carpetaDestino.$archivoNombre;
    // // var_dump($rutaDestino);
    // // die();
    // // Mover el archivo desde el directorio temporal a la carpeta 'uploads'
    if (move_uploaded_file($_FILES['archivoDocumento']['tmp_name'], $rutaDestino)) {
        // echo "El archivo se ha subido y guardado correctamente en 'uploads'.";
        // print_r("el archivo se ha subido y guardado correctamente");
        
    } else {
        // print_r("el archivo no se ha subido y guardado correctamente");

        // echo "Error al mover el archivo a la carpeta de destino.";
    }
    // echo $rutaDestino;
    $enviarCorreo->enviarCorreoAdjuntoDocumento($emailDestino,$rutaDestino,$archivoNombre);
} else {
    // Manejar el error de carga según sea necesario
    $archivoContenido = null;
    $archivoExtension = null;
}

// var_dump($archivoContenido);
// die();
//VALEEEEEEEEEE
// $movimientoModel = new Movimiento();
// $movimientoModel->setCasilla($nroCasilla);
// $movimientoModel->setNroDocumento($nroDocumento);

// $movimientoModel->setTipoDocumento($tipoDocumento);
// $movimientoModel->setFechaDocumento($fechaDocumento);
// $movimientoModel->setFechaNotificacion($fechaNotificacion);
// $movimientoModel->setSumilla($sumilla);
// $movimientoModel->setArea($areaNotificacion);
// $movimientoModel->setSede($sedeNotificacion);
// $movimientoModel->setUsuario($idUsuario);
// // Si hay archivo, asignarlo al modelo
// if ($archivoContenido !== null && $archivoExtension!==null) {
//     $movimientoModel->setArchivoDocumento($archivoContenido);
//     $movimientoModel->setExtensionDocumento($archivoExtension); // Asegúrate de tener este campo en tu modelo y base de datos
// }

$response=$movimientoModel->registrarMovimiento();

print json_encode($response);
