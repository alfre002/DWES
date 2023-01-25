<?php

require_once './funciones.php';

try {
    comprobrar_sesion();
    $mensaje = 'Ha escrito y confirmado la palabra ' . $_SESSION['palabra1'];

} catch (Exception $ex) {
    $mensaje = $ex->getMessage();
}

?>

<html>
    <head>
        
    </head>
    
    <body>
        <?= $mensaje ?>
        <br>
        <a href="borrar.php"> Volver al principio</a>
    </body>
</html>