<?php
require_once './funciones.php';
//llamar a la funcion para comprobar si la sesion esta abierta
comprobarSesion();

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
    // consulta de familias de productos
    $sql = "SELECT * FROM familia";
    $stock = $conexionbd->query($sql);
} catch (Exception $ex) {
    die($ex->getMessage());
    exit;
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
            <h1>Listado de Familias</h1>   
        </div>
        <br>
        <div id="contenido">
            <h2> Familias </h2>

            <ul>
                <?php foreach ($stock as $value): ?>
                    <li>
                        <a href="listadoProductos.php?familia=<?=$value['cod']?>"> <?= $value['nombre'] ?> </a>
                    </li>
                <?php endforeach ?>
            </ul>

        </div>
    </body>
</html>