<?php

require_once './DB.php';
require_once './funciones.php';
require_once './CestaCompra.php';
require_once './Producto.php';

comprobarSesion();
$codFamilia = '';

try {
    $cesta = CestaCompra::carga_cesta();
    $stock = DB::obtenerFamilias();
    // si se pulsa el botón vaciar
if(isset($_POST['vaciar'])) {
    $cesta = new CestaCompra();
    $_SESSION['cesta'] = $cesta;
}
} catch (Exception $ex) {
    $mensaje = 'Error: ' . $ex->getMessage();
}

?>

<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <link href="dwes.css" rel="stylesheet" type="text/css">
    </head>
    <body>
        <div id="encabezado">
            <h1>Listado de Familias</h1>   
        </div>
        <br>
        <div id="contenido">
            <h2> Familias </h2>

            <ul>
                <?php foreach ($stock as $value): ?>
                    <li>
                        <a href="listadoProducto.php?familia=<?=$value['cod']?>"> <?= $value['nombre'] ?> </a>
                    </li>
                <?php endforeach ?>
            </ul>

            
            <div id="cesta">
                <?php if (!($cesta->is_vacia())): ?>
                    <h2>Cesta</h2>
                    <hr>
                    <?php foreach ($cesta->getCesta() as $producto): ?>
                    <?= $producto['producto']->getCod() . ' x ' . $producto['unidades'] ?>
                        
                    <?php endforeach ?>
                    <form method="POST" action="<?php echo $_SERVER['PHP_SELF'] ?>?familia=<?= $codFamilia ?>">
                        <br><br><input type="submit" name="vaciar" value="Vaciar Cesta">
                    </form>
                    <form method="POST" action="cesta.php">
                        <input type="submit" name="comprar" value="Comprar">
                    </form>
                <?php endif; ?>  
            </div>
        </div>
    </body>
</html>