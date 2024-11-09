<?php
require_once __DIR__ . '/../../config/parameters.php';
require_once __DIR__ . "/../../views/personas/registrarPersonas.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión</title>
    <link rel="stylesheet" href="<?= base_url ?>assets/css/styles.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

</head>

<body>
    <div class="login-sinoe">
        <div class="header-login-sinoe" style="display: flex;gap: 100px;">
            <div class="logo-login-sinoe-mde">
                <img src="<?= base_url ?>assets/Nexis.png" style="margin-left: 70px;width: 210px;height: 200px;">
            </div>
            <div class="title-login-sinoe-mde" style="margin-top: 70px">
                <h2 style="color: #006B2D;">Notificaciones Electrónicas de Experiencias Interactivas y Sencillas</h2>

            </div>
        </div>
        <hr style="height: 5px;background-color:#006B2D !important">
        <div class="content-login-sinoe" style="display: flex; gap:0px">
            <div class="mensaje-inicial-sinoe" style="margin-left: 50px;margin-top:35px">
                <p style="text-align: justify;">
                    Bienvenido al Sistema de Notificaciones Electrónicas - Nexis, donde podrá recepcionar <br>
                     sus documentos como: Resoluciones, Notificaciones y otros Actos Administrativos.
                </p>
                <img src="<?= base_url ?>assets/Nexis.png" style="margin-left: 200px;width: 350px;">
            </div>
            <div class="formulario-login-sinoe-mde" style="margin-top: 35px;background-color: rgb(240, 240, 240);">
                <span>Iniciar Sesión</span>
                <div>
                    <form class="formLogin" id="formLogin" action="" method="post">
                        <div class="input-group">
                            <i class="fas fa-user"></i>
                            <input autofocus type="text" name="Usuario" id="Usuario" autocomplete="off" placeholder="Ingresa tu usuario" required>
                        </div>
                        <div class="input-group">
                            <i class="fas fa-lock"></i>
                            <input type="password" name="Password" id="Password" minlength="8"  autocomplete="off" placeholder="Ingresa tu contraseña" required>
                        </div>
                        <div>
                            <button id="btnLogin" class="login-btn">Ingresar</button>
                        </div>
                        <div class="help-link">
                            <p>Si no tiene usuario <a id="btnSolicitarCasilla" href="#">Solicitar Registro de Casilla</a></p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <footer class="footer-login-sinoe">
        Recuerda revisar tus notificaciones electrónicas para mantenerte informado y al día con nuestras últimas actualizaciones y servicios.
        </footer>
    </div>
    <?php require_once "validacionDobleFactor.php"?>
    <script src="<?= base_url ?>ajax/login.js"></script>
    <script src="<?= base_url ?>ajax/personas.js"></script>
    <script src="<?= base_url ?>ajax/tipodocidentidad.js"></script>
    <script src="<?= base_url ?>ajax/tipopersonas.js"></script>


</body>

</html>