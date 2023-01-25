 <?php
//variables para la conexion
$usuario = 'dwes';
$contraseña = 'abc123.';
$host = '127.0.0.1';
$bd = 'dwes';
$pintar = false;
$vacio = null;
$codProd = null;
$mensaje = "";
$stock = null;

//conexion
$cadenaConexion = "mysql:dbname=$bd;host=$host";
try {
    $conexionbd = new PDO($cadenaConexion, $usuario, $contraseña);
    echo 'conectado';
} catch (Exception $ex) {
    echo 'No se ha realizado la conexión.';
    exit;
}

// 1ª consulta
$sql = "select nombre, cod from producto";
$stock1 = $conexionbd->query($sql);

// recoger código del producto
if (isset($_POST['cod_prod'])) {
    $codProd = $_POST['cod_prod'];
}

// comprobar si se ha pulsado el boton modificar
if (isset($_POST["actualizar"])) {

    $unidadesModificadas = $_POST["modificar"];
    $tiendaModificada = $_POST["tienda_modificada"];

    // consulta de actualizar
    $update = "UPDATE stock"
            . " SET unidades = ? "
            . " WHERE producto = '" . $codProd . "'"
            . " AND tienda = ?";

    // hacemos consulta preparada
    $resultadoUpdate = $conexionbd->prepare($update);

    for ($i = 0; $i < count($tiendaModificada); $i++) {
        $resultadoUpdate->execute(array($unidadesModificadas[$i], $tiendaModificada[$i]));
    }

    // actualizar datos y mostrarlos
    $resultado = $resultadoUpdate->fetchAll();
}

// comprobar si se ha pulsado el botón
if (isset($codProd)) {

    // 2ª consulta
    $nombreTienda = "select producto.nombre as nombre_producto, tienda.nombre as tienda_modificada,"
            . " stock.unidades, tienda.cod as cod_tienda from tienda"
            . " inner join stock on tienda.cod = stock.tienda"
            . " inner join producto on producto.cod = stock.producto"
            . " where stock.producto = '" . $codProd . "'";

    // ejecutamos la consulta
    $consultaFinal = $conexionbd->query($nombreTienda);

    // comprobamos si se ha realizado la consulta
    if ($consultaFinal) {
        $stock = $consultaFinal->fetchAll(PDO::FETCH_ASSOC);
    }

    // comprobar si la tabla recoge datos
    if (count($stock) == 0) {
        $mensaje = "no hay datos.";
    } else {
        $pintar = true;
    }
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

            <!-- pintar el array-->
            <?php print_r($stock) ?>

            <h1>Ejercicio: </h1>
            <form id="form_seleccion" action="<?php echo $_SERVER['PHP_SELF'];
            ?>" method="post">
                <label>Productos</label>

                <select name="cod_prod">
                    <?php foreach ($stock1 as $value): ?>  
                    
                    <?php if($codProd==$value["cod"]) :?>">
                    
                        <!-- Para que se quede seleccionada la que ya está -->
                        <option value="<?= $value["cod"] ?>" selected>
                            <?= $value["nombre"] ?>
                        </option>
                        
                    <?php else:?>">
                        <option value="<?= $value["cod"] ?>">
                            <?= $value["nombre"] ?>
                        </option>
                    <?php endif?>
                        
                        
        <?php if($cod_prod==$value["cod"]) :?>" selected><?= $value["nombre"] ?><?php else:?>"><?=$value["nombre"]?><?php endif?>

                    <?php endforeach; ?>            
                </select>

                <input type="submit" name= "enviar" value="Enviar"/>
            </form>

        </div>

        <div id="contenido">

            <?php if ($pintar): ?>     

                <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">               

                    <?php foreach ($stock as $value) : ?>

                        <p>Tienda: <?= $value['tienda_modificada'] ?></p>
                        <p>Unidades: </p>

                        <input
                            type="text"
                            name="modificar[]"
                            value="<?= $value['unidades'] ?>"/>

                        <input
                            type="hidden"
                            name="tienda_modificada[]"
                            value="<?= $value['cod_tienda'] ?>"/>

                    <?php endforeach ?>

                    <input type="hidden" name="cod_prod" value="<?= $codProd ?>">
                    <input type="submit" name="actualizar" value="Actualizar">

                </form> 

            <?php else: ?>
                <?= $mensaje ?>
            <?php endif ?>

        </div>

    </body>
</html>