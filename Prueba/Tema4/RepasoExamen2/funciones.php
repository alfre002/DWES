<?php

function comprobrar_usuario($usuario, $contraseña) {
    try {
        // conexion
        $conexion = new PDO('mysql:host=127.0.0.1;dbname=tiendas', 'root', 'Visoalcor1');
        // consulta
        $sql = 'SELECT * FROM usuarios '
                . 'WHERE usuario=:usuario and password=:password';
        $sentencia = $conexion->prepare($sql);
        $sentencia->bindParam(':usuario', $usuario);
        $password = md5($contraseña);
        $sentencia->bindParam(':password', $password);
        if($sentencia->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    } catch (PDOException $e) {
        throw $e;
    }
}

?>