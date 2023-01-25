<?php
require_once './funciones.php';

//llamar a la funcion para comprobar si la sesion esta abierta
comprobarSesion();
cargarCesta();

// comprobar si se ha pulsado algún enlace de la lista de familias
if (isset($_REQUEST['familia'])) {
    //variables para la conexion
    $usuario = 'root';
    $contraseña = 'Visoalcor1';
    $host = '127.0.0.1';
    $bd = 'tiendas';
    $mensaje = "";

    //conexion
    $cadenaConexion = "mysql:dbname=$bd;host=$host";
    try {
        $conexionbd = new PDO($cadenaConexion, $usuario, $contraseña);
        $codFamilia = $_REQUEST['familia'];
        // consulta de los productos
        $sql = "SELECT nombre_corto, PVP, cod FROM producto "
                . "WHERE familia =:familia";

        // hacemos consulta preparada
        $resultadoUpdate = $conexionbd->prepare($sql);

        // parametros
        $parametros = [":familia" => $codFamilia];

        // ejecutar consulta
        $resultadoUpdate->execute($parametros);

        // comprobar si se ha realizado la consulta
        $resultado = $resultadoUpdate->fetchAll();
        
        $cesta = cargarCesta();
        
        // pulsar botón añadir
        if(isset($_POST['añadir'])) {
            // añado el producto pulsado a la cesta
            $codProd = $_POST['codProd'];
            $nombre = $_POST['nombre'];
            $pvp = $_POST['PVP'];
            $unidades = null;
            $producto = ['nombre' => $nombre, 'cod' => $codProd, 'pvp' => $pvp, 'unidades' => 1];
            anadirProducto($cesta, $producto, $codProd, $unidades);
            // guardo todo en la sesión
            $_SESSION['cesta'] = $cesta;
        }
        
        // boton vaciar cesta
        if(isset($_POST['vaciar'])) {
            $cesta = [];
            $_SESSION['cesta'] = $cesta;
        }
        
    } catch (Exception $ex) {
        die($ex->getMessage());
        exit;
    }
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
                <form method="POST" action="<?php echo $_SERVER['PHP_SELF'] ?>?familia=<?=$codFamilia?>">
                    <p> <?= $value['nombre_corto'] ?>: <?= $value['PVP'] ?>€  <input type="submit" name="añadir" value="Añadir"> </p>           
                    <input type="hidden" name="codProd" value="<?=$value['cod']?>">
                    <input type="hidden" name="nombre" value="<?=$value['nombre_corto']?>">
                    <input type="hidden" name="PVP" value="<?=$value['PVP']?>">
                </form>
            <?php endforeach ?>
            
            <div id="cesta">
                <?php if(isset($_SESSION['cesta'])): ?>
                    <h2>Cesta</h2>
                    <hr>
                    <?php foreach ($cesta as $value): ?>
                        <?= $value['cod'] . ' x ' . $value['unidades'] . "<br>"?>
                    <?php endforeach ?>
                    <form method="POST" action="<?php echo $_SERVER['PHP_SELF'] ?>?familia=<?=$codFamilia?>">
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