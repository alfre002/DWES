<?php

require_once './funciones.php';

try {
    comprobrar_sesion();
    $palabra2 = $_POST['palabra2'];
    if($palabra2 == '') {
        header('Location:sesiones3.php?error=vacio');
    } elseif(!ctype_alnum($palabra2) || ctype_space($palabra2)) {
        header('Location:sesiones3.php?error=espacio');
    } elseif(ctype_alnum($palabra2) && $palabra2 == $_SESSION['palabra1']) {
        header('Location:sesiones5.php');
    } elseif(ctype_alnum($palabra2) && $palabra2 != $_SESSION['palabra1']) {
        header('Location:sesiones1.php?error=noiguales');
    }
    
} catch (Exception $ex) {
    throw $ex;
}

?>