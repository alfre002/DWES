<?php

require_once './funciones.php';

// comprobrar sesion
try {
    comprobrar_sesion();
    // recoger palabra
    $palabra1 = $_POST['palabra'];
    
    // errores
    if($palabra1 == '') {
        header('Location:sesiones1.php?error=vacio');
    } elseif(ctype_space($palabra1) || !ctype_alnum($palabra1)) {
        header('Location:sesiones1.php?error=error1');
    } else {
        $_SESSION['palabra1'] = $palabra1;
        header('Location:sesiones3.php');
    }
} catch (Exception $ex) {
    throw $ex;
}
?>