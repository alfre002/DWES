<?php
// variables conexion
$usuario = 'dwes';
$password = 'abc123.';
$host = '127.0.0.1';
$pintar = false;

// conexion
try {
    $bd = new PDO("mysql:host=$host;dbname=dwes", $usuario, $password);
    echo 'conectado';
} catch (PDOException $e) {
    echo 'no ha entrado';
    exit;
}

// recoger productos
$sql = "SELECT * FROM producto";
$stock = $bd->query($sql);

// comprobar si se ha enviado un código de producto
if (isset($_POST['codProd'])) {
    $codProd = $_POST['codProd'];
}

// si se pulsa el botón enviar
if (isset($codProd)) {
    $sql = "SELECT tienda.nombre as nombreTienda, stock.unidades,"
            . "tienda.cod as codTienda, producto.nombre as nombreProducto "
            . "FROM tienda INNER JOIN stock ON tienda.cod = stock.tienda "
            . "INNER JOIN producto ON producto.cod = stock.producto "
            . "WHERE stock.producto = '" . $codProd . "'";
    $resultado = $bd->query($sql);
    if ($resultado) {
        $stock2 = $resultado->fetchAll();
    }

    if (count($stock2) == 0) {
        $mensaje = 'No hay datos.';
    } else {
        $pintar = true;
    }
}

// si se pulsa botón modificar
if (isset($_POST['actualizar'])) {
    $unidadesModificadas = $_POST['modificar'];
    $tiendasModificadas = $_POST['tienda_modificada'];
    $sql = "UPDATE stock SET "
            . "unidades =? "
            . "WHERE producto = '" . $codProd . "'"
            . " AND tienda =? ";
    $sentencia = $bd->prepare($sql);
    for ($i = 0; $i < count($tiendasModificadas); $i++) {
        $sentencia->execute(array($unidadesModificadas[$i], $tiendasModificadas[$i]));
    }
    $resultado = $sentencia->fetchAll();
}
?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <title>HTML</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link type="text/css" rel="stylesheet" href="dwes.css">
    </head>

    <body>
        <div id="encabezado">
            <h1>Ejercicio</h1>
            <form method="post" action="<?= $_SERVER['PHP_SELF'] ?>">
                <label>Productos</label>
                <select name="codProd">
                    <?php foreach ($stock as $value): ?>
                        <option value="<?= $value['cod'] ?>"><?= $value['nombre'] ?></option>
                    <?php endforeach ?>
                </select> 
                <input type="submit" name="enviar" value="Enviar">
            </form>
        </div>

        <div id="contenido">
            <?php if ($pintar): ?>
                <form method="post" action="<?= $_SERVER['PHP_SELF'] ?>">
                    <?php foreach ($stock2 as $value): ?>
                        <p>Tienda: <?= $value['nombreTienda'] ?></p>
                        <p>Unidades:</p>
                        <input type="text" name="modificar[]" value="<?= $value['unidades'] ?>">
                        <input
                            type="hidden"
                            name="tienda_modificada[]"
                            value="<?= $value['codTienda'] ?>"/>
                        <?php endforeach ?>
                    <input type="hidden" name="cod_prod" value="<?= $cod_prod ?>">
                    <input type="submit" name="actualizar" value="Actualizar">
                </form>
            <?php else: ?>
                <?=$mensaje ?>
            <?php endif ?>
    </body>
</html>