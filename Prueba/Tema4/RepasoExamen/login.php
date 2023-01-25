<?php

require_once './funciones.php';

// conexión bd
try {
    $conexion = conexion();
    $mensaje = null;
    
    // consultar si los datos introducidos son correctos
    if(isset($_POST['enviar'])) {
        // recoger datos
        $usuario = $_POST['usuario'];
        $password = md5($_POST['password']);
        
        // consulta preparada
        $consulta = "SELECT * FROM usuarios "
                . "WHERE usuario=:usuario and password=:password";
        $sentencia = $conexion->prepare($consulta);
        $sentencia->bindParam(':usuario', $usuario);
        $sentencia->bindParam('password', $password);
        $sentencia->execute();
        // si hay resultados abro una sesión
        if($sentencia->rowCount()>0) {
            session_start();
            $_SESSION['usuario'] = $usuario;
            // me lleva a otra página
            header('Location:listadoFamilias.php');
        } else 
            $mensaje = "Usuario o contraseña incorrectos.";
    }
} catch (Exception $e) {
    $mensaje = "Error: " . $e->getMessage();
}


?>

<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<!-- Tienda Web: login.php -->
<html>
<head>
  <meta http-equiv="content-type" content="text/html; charset=UTF-8">
  <title>Login Tienda</title>
  <link href="tienda.css" rel="stylesheet" type="text/css">
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