
<script src="<?=base_url ?>/ajax/logout.js"></script>
<div class="content">

    <header class="header" style="background-color: white;text-decoration: solid;">
        <h1 style="color: black;font-weight: bold;font-size: 15px;">Notificaciones Electrónicas de Experiencia Interactiva y Sencilla - NEXIS</h1>
        <div class="container_userDetails_logout">
            <div class="userDetails">
                <div>
                    <span style="color: white;" id="nombresUsuarioLog"> <?php echo $_SESSION['Persona'] ?> <span class="username">(<?php echo trim($_SESSION['TipoUsuario'])?>)</span> </span>
                    <div class="username_rol">
                        <?php if (trim($_SESSION['TipoUsuario']) == 'ADMINISTRADOR'):  ?> 
                        <a id="PerfilUsuarioAdmin" href="" style="color: white;margin-left: 200px;">Editar Pefil</a>
                        <?php endif; ?>
                        <?php if (trim($_SESSION['TipoUsuario']) != 'ADMINISTRADOR' && trim($_SESSION['TipoPersona'])=='NATURAL'):  ?> 
                        <a id="PerfilUsuarioNormal" href="" style="color: white;margin-left: 0px;">Editar Pefil</a>
                        <?php endif; ?>
                        <?php if (trim($_SESSION['TipoUsuario']) != 'ADMINISTRADOR' && trim($_SESSION['TipoPersona'])=='JURIDICO'):  ?> 
                        <a id="PerfilUsuarioJuridicoNormal" href="" style="color: white;margin-left: 0px;">Editar Pefil</a>
                        <?php endif; ?>
                     </div>
                </div>
            </div>
        </div>
        <div class="fondo_blanco" style="background-color: #006B2D;">
        </div>
    </header>
    <div class="main">
    <?php  require_once "views/inicio.php"?>
