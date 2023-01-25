<?php

require_once './funciones.php';

try {
    comprobrar_sesion();
    $palabra1 = $_POST['palabra'];
    if($palabra1 == '') {
        header('Location:sesiones1.php?error=vacio');
    } elseif(!ctype_alnum($palabra1) || ctype_space($palabra1)) {
        header('Location:sesiones1.php?error=espacio');
    } elseif(ctype_alnum($palabra1)) {
        $_SESSION['palabra1'] = $palabra1;
        header('Location:sesiones3.php');
    }
    
} catch (Exception $ex) {
    throw $ex;
}

?>