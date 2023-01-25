<?php



?>

<html>
<head>
  <meta http-equiv="content-type" content="text/html; charset=UTF-8">
  <title>Listado Productos Tienda</title>
  <link href="tienda.css" rel="stylesheet" type="text/css">
</head>

<body>
    <div id="encabezado">
        <h1>Cesta de Productos</h1>
    </div>
    <div class="pagproductos">
    <fieldset >
        <div><span class='error'><?= $mensaje ?></span></div>
        <?php foreach($resultado as $value): ?>
            <form action='<?php echo ($_SERVER["PHP_SELF"]) ?>?familia=<?=$familia?>' method='post'>
            <p> <input type="submit" name="añadir" value="Añadir"> <?= $value['nombre_corto'] . ' ' . $value['PVP'] . '€' ?> </p>
            <input type="hidden" name="codProd" value="<?=$value['cod']?>">
            <input type="hidden" name="nombre" value="<?=$value['nombre_corto']?>">
            <input type="hidden" name="pvp" value="<?=$value['PVP']?>">
            </form>
        <?php endforeach; ?>       
    </fieldset>
        <form method="post" action="logout.php">
            <input type="submit" name="cerrar" value="Cerrar Sesion">
        </form>
    </div>
</body>
</html>