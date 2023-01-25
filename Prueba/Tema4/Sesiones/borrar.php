<?php

require_once './funciones.php';

try {
    // comprobar sesion
    comprobrar_sesion();
    
    // borrar variables de la sesión
    $_SESSION = [];
    
    // borrar cookies de la sesión
    if(ini_get('session.use_cookies')) {
        $params = session_get_cookie_params();
        setcookie(session_name(), '', time() - 42000,
                $params['path'], $params['domain'],
                $params['secure'], $params['httponly']);
    }
    
    // destruir la sesión
    session_destroy();
    
    // volver a login
    header('Location:login.php');
    
} catch (Exception $ex) {
    throw $ex;
}

?>