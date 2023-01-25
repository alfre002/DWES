<?php
/* Define una función que calcule y devuelva el precio con IVA (21%) a partir de
  una cantidad pasada como parámetro. Utiliza una función matemática
  predefinida para redondear el resultado a dos decimales.
  Obtén el precio con IVA de las cantidades dadas llamando a la función
  anterior y muéstralo en el lugar correspondiente en la tabla proporcionada en
  la plantilla. */

require_once './funciones.php';

?>

<!DOCTYPE HTML>
<html>
    <head>
        <meta charset="utf-8">
        <title>Tabla precios con y sin IVA</title>
        <style>
            table, th, td {
                border:1px solid white;
                border-collapse: collapse;

            }
            th, td {
                background-color: #96D4D4;
            }
        </style>
    </head>

    <body>
        <h1>Tabla precios con y sin IVA</h1>
        <table>
            <tr>
                <th>SIN IVA</th>
                <th>% IVA</th>
                <th>CON IVA</th>
            </tr>
            <tr>
                <td>33,50€</td>
                <td>21%</td>
                <td><?= precioIVA(33.5) ?></td>
            </tr>
            <tr>
                <td>75€</td>
                <td>21%</td>
                <td><?= precioIVA(75) ?></td>
            </tr>
        </table>




    </body>
</html>