<?php

/* Escribe un programa con dos páginas que muestre una tabla de una columna:
a) En la primera página se solicita el número de filas mediante un
formulario.
▪ No se deben admitir números decimales ni negativos.
▪ Sólo se deben admitir enteros positivos inferiores o iguales a 200 y
superiores a 0.
b) En la segunda página se muestra la tabla (con un límite de 200 filas).
▪ Para generar la tabla es suficiente un único bucle. */



?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>
    Tabla de una columna (Formulario).
     </title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="php-ejercicios.css" title="Color">
</head>

<body>
  <h1>Tabla de una columna (Formulario)</h1>

  <form action="filas2.php" method="post">
    <p>Escriba un número (0 &lt; número &le; 200) y mostraré una tabla de una columna
      y tantas filas como indique.
    </p>

    <p><label>Número de filas: <input type="number" name="filas" min="1" max="200" value="10"></label></p>

    <p>
      <input type="submit" value="Mostrar">
      <input type="reset" value="Borrar">
    </p>
  </form>
</body>
</html>