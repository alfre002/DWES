<?php
// realizar una tirada de 1 a 10 dados aleatoria del 1 al 6 y luego mostrar cuantos pares e impares hay.
$nDados = rand(1, 10);
$pares = 0;
$impares = 0;

for ($i = 0; $i < $nDados; $i++) {
    $tiradas[$i] = rand(1, 6);
    if ($tiradas[$i] % 2 == 0) {
        $pares++;
    } else {
        $impares++;
    }
}
?>

<html>
    <head>
        <meta http-equiv="content-type" content="text/html;
              charset=UTF-8">
        <title>Plantilla para Ejercicios Tema 3</title>
        <link href="dwes.css" rel="stylesheet" type="text/css">
    </head>
    <body>
        <?php foreach($tiradas as $value): ?>
            <img src="./img/<?=$value?>.svg">
        <?php endforeach; ?>
            
        <?= "<br>Tiradas pares: $pares <br>" ?>
        <?= "Tiradas impares: $impares" ?>
    </body>
</html>