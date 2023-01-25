<?php

$color = $_COOKIE['color'];
if($color == 'ninguno') {
    $mensaje = 'No se ha elegido ningún color.';
} else {
    $mensaje = 'Se ha elegido el color ' . $color;
}

?>

<html>
    <head>
        <link rel="stylesheet" href="color.css"/>
    </head>
    
    <body>
        <div class='<?= $color ?>'>
        <?= $mensaje ?>
            <br>
            <a href='colores.php'> Volver a la selección del color </a>
        
        </div>
    </body>
</html>