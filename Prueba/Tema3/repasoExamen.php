<?php
// variables para conexion
$hostname = '127.0.0.1';
$username = 'dwes';
$password = 'abc123.';
$database = 'dwes';
$codProd = null;
$nombre_producto_selec = null;

// probamos conexion
try {
    $bd = new mysqli($hostname, $username, $password, $database);
} catch (Exception $ex) {
    die('<p>Error conexión: ' . $e->getMessage() . '</p>');
}

// recoger código del producto
if (isset($_POST['cod_prod'])) {
    $codProd = $_POST['cod_prod'];
}

// comprobar si se ha metido algun codigo de producto
if (isset($codProd)) {
    // consulta del stock
    $sql = "SELECT tienda.nombre, stock.unidades, tienda.cod as codTienda "
            . "FROM stock INNER JOIN tienda ON stock.tienda = tienda.cod "
            . "WHERE stock.producto = '" . $codProd . "'";

    $resultado_stock = $bd->query($sql);
    if ($resultado_stock) {
        $stock = $resultado_stock->fetch_all(MYSQLI_ASSOC);
    }
}

// comprobar si se ha pulsado modificar
if (isset($_POST['modificar'])) {
    $tiendasModificadas = $_POST['tiendas'];
    $unidadesModificadas = $_POST['unidades'];
    $consultaPreparada = $bd->stmt_init();
    $sql = "UPDATE stock SET unidades =? ";
}

// sacar productos
$sql = "SELECT * FROM producto";
$resultado = $bd->query($sql);
if ($resultado) {
    $productos = $resultado->fetch_all(MYSQLI_ASSOC);
    // sacar fila a fila
    foreach ($productos as $value) {
        if ($value['cod'] == $codProd) {
            $nombre_producto_selec = $value['nombre'];
        }
    }
} else {
    $mensaje = "La consulta no se ha realizado correctamente.";
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
            <h1>Ejercicio:</h1>
            <form method="post" action="<?= $_SERVER['PHP_SELF'] ?>">
                <label>Productos</label>
                <select name="cod_prod">
                    <?php foreach ($productos as $value): ?>
                        <?php if ($codProd == $value['cod']): ?>
                            <option value="<?= $value['cod'] ?>" selected><?= $value['nombre'] ?></option>
                        <?php else: ?>
                            <option value="<?= $value['cod'] ?>"><?= $value['nombre'] ?></option>
                        <?php endif ?>
                    <?php endforeach ?>
                </select>
                <input type="submit" name="enviar" value="Enviar">
            </form>
        </div>

        <div id="contenido">
            <h2>Stock del producto <?= $nombre_producto_selec ?></h2>

            <?php if (isset($codProd) && count($stock) != 0): ?>
                <?php print_r($stock) ?>

                <form method="post" action="<?= $_SERVER['PHP_SELF'] ?>">
                    <?php foreach ($stock as $value): ?>
                        <p>Tienda <?= $value['nombre'] ?><input type="text" name="unidades[]" value="<?= $value['unidades'] ?>"></p>
                        <input type="hidden" name="tiendas[]" value="<?= $value["codTienda"] ?>">
                    <?php endforeach; ?>
                    <input type="hidden" name="cod_prod" value="<?= $codProd ?>">
                    <input type="submit" name="modificar" value="Modificar">
                </form>
            <?php elseif (isset($stock) && count($stock) == 0): ?>
                <p>No hay stock de este producto.</p>
            <?php endif ?>
        </div>

    </body>
</html>