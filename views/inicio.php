<?php
if (!isset($_SESSION)) {
    session_start();
}
// setlocale(LC_TIME, 'es_ES.UTF-8');  // Configura el idioma en español
$locale_es = setlocale(LC_TIME, 'es_ES.UTF-8', 'es_ES', 'Spanish_Spain', 'es');

?>

<div class="inicio">
    <h1>Bienvenido(a), <?= $_SESSION['Persona'] ?></h1>
</div>
<!-- <div>
    <label for=""><?= strftime("%e de %B del %Y"); ?></label>
</div> -->