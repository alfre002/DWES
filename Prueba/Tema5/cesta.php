<?php

// comprobar si se ha pulsado el botón comprar
require_once './funciones.php';
require_once './CestaCompra.php';

//llamar a la funcion para comprobar si la sesion esta abierta
comprobarSesion();

// recoger productos de la cesta
$cesta = CestaCompra::carga_cesta();

// variable precio total
$coste = $cesta->getCoste();

?>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <link href="tienda.css" rel="stylesheet" type="text/css">
    </head>
    <body>
        <div id="encabezado">
            <h1>Cesta de la Compra</h1>
        </div>
        <br>
        <div id="contenido">
            
            <form method="POST" action="pagar.php">
                <table>
                    <tr>
                        <th>Código</th>
                        <th>Nombre</th>
                        <th>Unidades</th>
                        <th>PVP</th>
                    </tr>
                <?php foreach ($cesta->getCesta() as $producto): ?>
                    <tr>
                        <td> <?= $producto['producto']->getCod() ?> </td>
                        <td> <?= $producto['producto']->getNombre_corto() ?> </td>
                        <td> <?= $producto['unidades'] ?> </td>
                        <td> <?= $producto['producto']->getPVP() ?> </td>
                    </tr>                                        
                <?php endforeach ?>
                </table>
                <?= "----------------------------------------------------<br>" ?>
                <?= "Precio Total: $coste €" ?>
                <input type="submit" name="pagar" value="Pagar">
            </form>
        </div>

    </body>
</html>


