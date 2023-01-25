<?php

// Escribe un programa que muestre una secuencia aleatoria de 10 bits. Utiliza
// un array numérico para almacenar cada bit (0 ó 1) obtenido.

$bits = [];
for($i = 0; $i < 10; $i++) {
    $bits[$i] = rand(0,1);
}


?>

<html>
    <head>
        <meta charset="utf-8">
    </head>
    
    <body>
        <?php foreach($bits as $value) {
            echo $value;
        } ?>
    </body>
</html>