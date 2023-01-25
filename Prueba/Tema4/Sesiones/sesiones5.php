<?php

require_once './funciones.php';

try {
    $mensaje = '';
    comprobrar_sesion(); 
    
} catch (Exception $ex) {
    $mensaje = $ex->getMessage();
}

?>

<html>
    <head>
<link rel="stylesheet" href="error.css"/>
    </head>

    <body>
        <div>
            <p> <?=$mensaje?></p>
            <p> Ha confirmado la palabra <?= $_SESSION['palabra1'] ?></p>
            <br>
            <a href="borrar.php"> Volver al principio</a>
        </div>
    </body>
</html>