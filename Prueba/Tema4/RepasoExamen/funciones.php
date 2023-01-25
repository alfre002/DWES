<?php

// conexion bd
function conexion () {    
    try {
        $conexion = new PDO('mysql:host=127.0.0.1; dbname=tiendas', 'root', 'Visoalcor1');
        return $conexion;
    } catch (PDOException $e) {
        throw $e;
    }
}

function comprobarSesion() {
    session_start();
    if(!isset($_SESSION['usuario'])) {
        header('Location:login.php');
    }
}

function cargarCesta() {
    if(!isset($_SESSION['cesta'])) {
        $_SESSION['cesta'] = [];
    } 
    return $_SESSION['cesta'];
}

function anadirProducto(&$cesta, $producto, $codProd, $unidades) {
    if(!array_key_exists($codProd, $cesta)) {
        $cesta[$codProd] = $producto;
    } else {
        $cesta[$codProd]['unidades']++;
    }
}

?>

