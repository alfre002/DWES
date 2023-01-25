<?php

require_once './funciones.php';

// comprobrar sesion
try {
    comprobrar_sesion();
    // recoger palabra
    $palabra2 = $_POST['palabra2'];
    
    // errores
    if($palabra2 == '') {
        header('Location:sesiones3.php?error=vacio');
    } elseif(ctype_space($palabra2) || !ctype_alnum($palabra2)) {
        header('Location:sesiones3.php?error=error1');
    } elseif(ctype_alnum($palabra2) && $palabra2 != $_SESSION['palabra1']) {
        header('Location:sesiones1.php?error=noiguales');
    } elseif(ctype_alnum($palabra2) && $palabra2 == $_SESSION['palabra1']) {
        header('Location:sesiones5.php');
    }
} catch (Exception $ex) {
    throw $ex;
}
?>