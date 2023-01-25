<?php

require_once './funciones.php';

// comprobamos si existe una sesión
comprobarSesion();

try {
    // conexión bd
    $conexion = conexion();
    $mensaje = null;
    $familia = $_REQUEST['familia'];
    
    // consulta de las familias
    $sql = "SELECT * FROM producto "
            . "WHERE familia=:familia";
    // hacemos consulta preparada
    $resultadoUpdate = $conexion->prepare($sql);

    // parametros
    $parametros = [":familia" => $familia];

    // ejecutar consulta
    $resultadoUpdate->execute($parametros);

    // comprobar si se ha realizado la consulta
    $resultado = $resultadoUpdate->fetchAll();
    
    // creo cesta
    $cesta = cargarCesta();
    
    // pulsar en añadir
    if(isset($_POST['añadir'])) {
        // recojo codProd
        $codProd = $_POST['codProd'];
        $nombre = $_POST['nombre'];
        $pvp = $_POST['pvp'];
        $unidades = 1;
        $producto = ['nombre' => $nombre, 'pvp' => $pvp, 'cod' => $codProd, 'unidades' => $unidades];
        anadirProducto($cesta, $producto, $codProd, $unidades);
        // guardo en la cesta
        $_SESSION['cesta'] = $cesta;
    }
        
    // pulsar en vaciar
    if(isset($_POST['vaciar'])) {
        $cesta = [];
        $_SESSION['cesta'] = $cesta;
    }    
    
} catch (Exception $e) {
    $mensaje = "Error: " . $e->getMessage();
}

?>

<html>
<head>
  <meta http-equiv="content-type" content="text/html; charset=UTF-8">
  <title>Listado Productos Tienda</title>
  <link href="tienda.css" rel="stylesheet" type="text/css">
</head>

<body>
    <div id="encabezado">
        <h1>Listado de Productos</h1>
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
        
        <div id="cesta">
            <h2>Cesta</h2>
            <hr>
            <?php foreach($cesta as $value): ?>
                <?= $value['cod'] . ' x ' . $value['unidades'] . '<br>'?>
            <?php endforeach; ?>
            <form method="post" action="listadoProductos.php?familia=<?=$familia?>">
                <input type="submit" name="vaciar" value="Vaciar Cesta">
            </form>
            <form method='post' action='cesta.php'>
                <input type="submit" name="comprar" value="Comprar">
            </form>
        </div>
    </fieldset>
    </div>
</body>
</html>