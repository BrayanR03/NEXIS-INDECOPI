<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require '../../Librerias/PHPMailer/src/PHPMailer.php';
require '../../Librerias/PHPMailer/src/SMTP.php';
require '../../Librerias/PHPMailer/src/Exception.php';

$mail = new PHPMailer(true);

try {
    $mail->SMTPDebug = SMTP::DEBUG_SERVER;
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'bryanneciosup626@gmail.com';
    $mail->Password = 'rqdefyjxtdxxkhgn';
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = 587;

    $mail->setFrom('bryanneciosup626@gmail.com', 'Sistema SINOE');
    $mail->addAddress('mvegape@ucvvirtual.edu.pe', 'Receptor');
    // $mail->addCC('concopia@gmail.com');

    // $mail->addAttachment('docs/dashboard.png', 'Dashboard.png');

    $mail->isHTML(true);
    $mail->Subject = 'Prueba desde GMAIL';
    $mail->Body = 'Hola Mr Devv, <br/>Esta es una prueba desde <b>Gmail</b>.';
    $mail->send();

    echo 'Correo enviado';
} catch (Exception $e) {
    echo 'Mensaje ' . $mail->ErrorInfo;
}