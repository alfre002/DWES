<?php

/* si se ha pulsado el botón cancelar nos redirige a la página principal
 * pero si se ha pulsado actualizar antes se realiza un update
 */
if (isset($_POST['cancelar'])) {
    header("Location: listado.php?resultado=cancelar");
} else {

    // Declaramos variables para la conexion
    $host = '127.0.0.1';
    $usuario = 'dwes';
    $password = 'abc123.';
    $bd = 'dwes';
    $pintar = false;

    // probar conexión
    $cadenaConexion = "mysql:dbname=$bd;host=$host";
    try {
        $bd = new PDO($cadenaConexion, $usuario, $password);
        // recojo los datos del producto editado
        $nombreCorto = $_POST['nombreCorto'];
        $nombreProd = $_POST['nombreProducto'];
        $descripcion = $_POST['descripcion'];
        $PVP = $_POST['PVP'];
        $codProd = $_POST['codProd'];

        // actualizo con una consulta
        $update = "UPDATE producto"
                . " SET nombre_corto = ?,"
                . "     nombre = ?,"
                . "     descripcion = ?,"
                . "     PVP = ?"
                . " WHERE cod = '" . $codProd . "'";

        // hacemos consulta preparada
        $resultadoUpdate = $bd->prepare($update);

        $resultadoUpdate->execute(array($nombreCorto, $nombreProd, $descripcion, $PVP));

        // actualizar datos y mostrarlos
        $resultado = $resultadoUpdate->fetchAll();
    } catch (Exception $ex) {
        exit;
    }

    // redireccionar a listado
    header("Location: listado.php?resultado=actualizar");
}
?>