<?php

require_once './DB.php';

$user = 'yimi';
$pass = password_hash('yimi', PASSWORD_DEFAULT);

$sql = "INSERT INTO usuarios(usuario, password) VALUES ('$user', '$pass')";

try {
    $usuario = "root";
    $contraseña = "Visoalcor1";
    $conexion = new PDO('mysql:host=127.0.0.1; dbname=tiendas', $usuario, $contraseña);
    $conexion->query($sql);
} catch (Exception $ex) {
    echo $ex->getMessage();
}
?>