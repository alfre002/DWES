<?php
require_once './DB.php';
require_once './CestaCompra.php';
require_once './Producto.php';
require_once './funciones.php';

comprobarSesion();

$cesta = CestaCompra::carga_cesta();

if (isset($_REQUEST['familia'])) {
    $codFamilia = $_REQUEST['familia'];
    try {
        // consulta preparada para obtener los productos
        $resultadoUpdate = DB::obtenerProductos($codFamilia);
        $resultado = $resultadoUpdate->fetchAll();
    } catch (Exception $ex) {
        die($ex->getMessage());
        exit;
    }
}

// si pulsa el botón añadir
if (isset($_POST['añadir'])) {

    // añado el producto pulsado a la cesta
    $codProd = $_POST['codProd'];
    $unidades = $_POST['unidades'];
    // carga el artículo
    $cesta->carga_articulo($codProd, $unidades);
    $cesta->guarda_cesta();
    print_r($cesta);
    
}

// si se pulsa el botón vaciar
if(isset($_POST['vaciar'])) {
    $cesta = new CestaCompra();
    $_SESSION['cesta'] = $cesta;
}
?>

<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <link href="tienda.css" rel="stylesheet" type="text/css">
    </head>
    <body>
        <div id="encabezado">
            <h1>Listado de Productos</h1>   
        </div>
        <br>
        <div class="pagproductos">

            <?php foreach ($resultado as $value): ?>
                <form method="POST" action="<?php echo $_SERVER['PHP_SELF'] ?>?familia=<?= $codFamilia ?>">
                    <p> <?= $value['nombre_corto'] ?>: <?= $value['PVP'] ?>€  
                        <input type="text" name="unidades" value="1">
                        <input type="submit" name="añadir" value="Añadir"> </p>           
                    <input type="hidden" name="codProd" value="<?= $value['cod'] ?>">
                </form>
            <?php endforeach ?>
            
            <a href="listadoFamilias.php">Volver a Listado de Familias</a>

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