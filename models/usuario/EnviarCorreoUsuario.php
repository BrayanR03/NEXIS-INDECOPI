<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require '../../Librerias/PHPMailer/src/PHPMailer.php';
require '../../Librerias/PHPMailer/src/SMTP.php';
require '../../Librerias/PHPMailer/src/Exception.php';

class EnviarCorreoUsuario
{
    public function enviar($correoReceptor,$usuario,$password)
    {
        $mail = new PHPMailer(true);

        try {
            // Configuración del servidor SMTP
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'bryanneciosup626@gmail.com';  // Cambia con tu correo
            $mail->Password = 'rqdefyjxtdxxkhgn';         // Cambia con tu contraseña de aplicación
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;

            // Configuración del remitente y destinatario
            $mail->setFrom('bryanneciosup626@gmail.com', 'Sistema SINOE');
            $mail->addAddress($correoReceptor);

            // Contenido del correo
            $mail->isHTML(true);
            $mail->Subject = 'Tus Credenciales del Sistema SINOE - Municipalidad Distrital de la Esperanza';
            $mail->Body = "Bienvenido al SISTEMA SINOE, este es tu USUARIO: ". $usuario .' y esta es tu CONTRASEÑA: '.$password;

            // Enviar el correo
            $mail->send();
            return 'Correo enviado exitosamente';
        } catch (Exception $e) {
            return 'Error al enviar el correo: ' . $mail->ErrorInfo;
        }
    }
    public function enviarCorreoAdjuntoDocumento($correoReceptor,$rutaDocumento,$nombreDocumento)
    {
        // echo $correoReceptor;
        // echo $rutaDocumento;
        // echo $nombreDocumento;
        $mail = new PHPMailer(true);

        try {
            // Configuración del servidor SMTP
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'bryanneciosup626@gmail.com';  // Cambia con tu correo
            $mail->Password = 'rqdefyjxtdxxkhgn';         // Cambia con tu contraseña de aplicación
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;

            // Configuración del remitente y destinatario
            $mail->setFrom('bryanneciosup626@gmail.com', 'Sistema SINOE');
            $mail->addAddress($correoReceptor);
            $mail->addAttachment($rutaDocumento, $nombreDocumento);

            // Contenido del correo
            $mail->isHTML(true);
            $mail->Subject = 'Copia de Acto Administrativo - Sistema SINOE - Municipalidad Distrital de la Esperanza';
            $mail->Body = "Has recibido una notificación en tu casilla electrónicas del SINOE - MDE, se adjunta una copia del Acto Administrativo.";

            // Enviar el correo
            $mail->send();
            // Eliminar el documento después de enviar el correo
        if (file_exists($rutaDocumento)) {
            unlink($rutaDocumento);
        }
            // print_r('Correo enviado exitosamente');
        } catch (Exception $e) {
            // Eliminar el documento después de enviar el correo
        if (file_exists($rutaDocumento)) {
            unlink($rutaDocumento);
        }
            // print_r('Error al enviar el correo: ' . $mail->ErrorInfo);
        }
    }
}
