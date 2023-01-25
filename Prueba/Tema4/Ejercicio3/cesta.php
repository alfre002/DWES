<?php

// comprobar si se ha pulsado el botón comprar
require_once './funciones.php';
//llamar a la funcion para comprobar si la sesion esta abierta
comprobarSesion();

// recoger productos de la cesta
$cesta = cargarCesta();

// variable precio total
$precioTotal = 0;

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
            
            <form>
                <table>
                    <tr>
                        <th>Código</th>
                        <th>Descripción</th>
                        <th>Unidades</th>
                    </tr>
                <?php foreach ($cesta as $value): ?>
                    <tr>
                        <td><?= $value['cod'] ?></td>
                        <td><?= $value['nombre'] ?></td>
                        <td><?= $value['unidades'] . ' x ' . $value['pvp'] ?></td>
                        <?php $precioTotal += $value['pvp']*$value['unidades']; ?>
                    </tr>
                <?php endforeach ?>
                </table>
                <?= "----------------------------------------------------<br>" ?>
                <?= "Precio Total: $precioTotal €" ?>
                <input type="submit" name="pagar" value="Pagar">
            </form>

        </div>

    </body>
</html>


