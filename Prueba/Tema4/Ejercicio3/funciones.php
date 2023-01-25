<?php

//hacer funcion
function comprobarSesion() {
    session_start();
    if (!isset($_SESSION['usuario'])) {
        header("Location: listadoFamilias.php");
    }
}

function cargarCesta() {
    if (!isset($_SESSION['cesta'])) {
        $_SESSION['cesta'] = [];
    }
    return $_SESSION['cesta'];
}

function anadirProducto(&$cesta, $producto, $codProd, $unidades) {
    if (!array_key_exists($codProd, $cesta)) {
        $cesta[$codProd] = $producto;
    } else {
        $cesta[$codProd]['unidades']++;
    }
}

?>
