<?php 

require_once './funciones.php';

// conexion bd
try {
    $mensaje = '';
    // recojo inputs
    if(isset($_POST['enviar'])) {
        $usuario = $_POST['usuario'];
        $contraseña = md5($_POST['password']);
        if(comprobrar_usuario($usuario, $contraseña)) {
            session_start();
            $_SESSION['usuario'] = $usuario;
            header('Location:sesiones1.php');
        } elseif($usuario == '' || $contraseña == '') {
            $mensaje = 'Debe introducir un usuario y una contraseña.';
        } else {
            $mensaje = 'Los valores son incorrectos.';
        }
    }
    // intruso
    if($_REQUEST['sesion']) {
        if($_REQUEST['sesion'] == 'false') {
            $mensaje = 'Debe iniciar sesión.';
        }
    }
} catch (Exception $ex) {
    $mensaje = $ex->getMessage();
}

?>

<html>
    <head>
        <link rel="stylesheet" href="error.css"/>
    </head>

    <body>
        <div id='login'>
            <form action='<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?>' method='post'>
                <fieldset >
                    <legend>Login</legend>
                    <div><span class='error'><?= $mensaje ?></span></div>
                    <div class='campo'>
                        <label for='usuario' >Usuario:</label><br/>
                        <input type='text' name='usuario' id='usuario' maxlength="50" /><br/>
                    </div>
                    <div class='campo'>
                        <label for='password' >Contraseña:</label><br/>
                        <input type='password' name='password' id='password' maxlength="50" /><br/>
                    </div>

                    <div class='campo'>
                        <input type='submit' name='enviar' value='Enviar' />
                    </div>
                </fieldset>
            </form>
        </div>
    </body>
</html>