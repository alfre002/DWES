<?php

function comprobrar_usuario($usuario, $contraseña) {
    try {
        // conexion
        $conexion = new PDO('mysql:host=127.0.0.1;dbname=tiendas', 'root', 'Visoalcor1');
        // consulta
        $sql = 'SELECT * FROM usuarios '
                . 'WHERE usuario=:usuario and password=:password';
        $sentencia = $conexion->prepare($sql);
        $parametros = [':usuario' => $usuario, ':password' => $contraseña];
        $sentencia->execute($parametros);
        if($sentencia->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    } catch (PDOException $e) {
        throw $e;
    }
}

function comprobrar_sesion() {
    session_start();
    if(!isset($_SESSION['usuario'])) {
        header('Location:login.php?sesion=false');
    }
}

?>