<?php   


//hacer funcion
function comprobarSesion() {
    session_start();
    if (!isset($_SESSION['usuario'])) {
        header("Location: login.php");
    }
}

function borrarSesion() {
    session_start();
    $_SESSION = array();
    if(ini_get("session.use_cookies")) {
        $params = session_get_cookie_params();
        setcookie(session_name(), '', time() - 42000,
                $params['path'], $params['domain'],
                $params['secure'], $params['httponly']);
    }
    session_destroy();
}

?>