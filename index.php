<?php
session_start();
require_once 'autoload.php';
require_once 'config/database.php';
require_once 'config/parameters.php';
require_once 'views/layouts/head.php';
date_default_timezone_set('America/Lima');
// $_SESSION['base_url']=base_url;

if(isset($_SESSION["autenticado"])){
    require_once "views/layouts/editarPerfilUsuario.php";
    require_once 'views/layouts/navbar.php';
    require_once 'views/layouts/content.php';

}else{
    require_once 'views/Login/login.php';
}

require_once 'views/layouts/footer.php'; 
?>