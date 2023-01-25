<?php

$color = null;

if(isset($_REQUEST['color'])) {
    $color = $_REQUEST['color'];
    $mensaje = 'Se ha elegido el color ' . $color;
}

if(isset($_REQUEST['nocolor'])) {
    $mensaje = 'No se ha elegido ningún color.';
    $color = $_REQUEST['nocolor'];
}

if(!isset($_COOKIE['color'])) {
    setcookie('color', $color, time() + 3600 * 24);
} else {
    setcookie('color', $color, time() + 3600 * 24);
}

?>

<html>
    <head>
        <link rel="stylesheet" href="error.css"/>
    </head>

    <body>
        <?php if(isset($mensaje)): ?>
        <?= $mensaje ?>
        <?php endif; ?>
        <br><br>
        <label>Cambio de color: <a href='colores.php?color=rojo'>Rojo</a> <a href='colores.php?color=azul'>Azul</a> <a href='colores.php?color=verde'>Verde</a> <a href='colores.php?nocolor=ninguno'>Ninguno</a> </label>
        <br><br>
        <a href='verColor.php'>Ir a otra página para comprobar cookie</a>
    </body>
</html>