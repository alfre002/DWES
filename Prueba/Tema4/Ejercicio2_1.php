<?php
/*
  Crea una página similar a la de autentificación de usuario por BD, en la que se
  almacene en una cookie el último instante en que el usuario visitó la página.
  Si es su primera visita, muestra un mensaje de bienvenida. En caso contrario,
  muestra la fecha y hora de su anterior visita.
 */

// variables para la conexion
$user = 'root';
$contraseña = 'Visoalcor1';
$host = '127.0.0.1';
$bd = 'empresa';
$mensaje = "";

// crear conexion
$cadenaConexion = "mysql:dbname=$bd;host=$host";
try {
    $conexionbd = new PDO($cadenaConexion, $user, $contraseña);
    echo 'Conectado';
} catch (Exception $ex) {
    echo 'No se ha realizado la conexión.';
    exit;
}

// comprobar si es la primera vez que se accede
if (isset($_POST['enviar'])) {
    // validar login
    $usuario = $_POST['usuario'];
    $clave = md5($_POST['clave']);
    $consulta = 'select * from usuarios '
              . 'where nombre =:nombre and ' 
              . 'clave =:clave ';
           
    // hacemos consulta preparada
    $resultadoUpdate = $conexionbd->prepare($consulta);
    
    // parametros
    $parametros = [":nombre" => $usuario, ":clave" => $clave];
    
    // ejecutar consulta
    $resultadoUpdate->execute($parametros);
    
    // contar filas
    $numFilas = $resultadoUpdate->rowCount();
    
    // si los datos introducidos están en la bd, muestro mensaje de bienvenida y guardar cookie de fecha y hora
    if($numFilas > 0) {
        // si me he logeado correctamente
        session_start();
        // guardo nombre usuario
        $_SESSION['usuario'] = $usuario;
        // redirecciono a la página de sesiones
        header('Location: sesiones.php');
    } else {
        $mensaje = "Usuario y/o contraseña incorrectas.";
    }
    
} else {
    // mostrar fecha y hora de la última conexión
}
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Formulario de login</title>		
        <meta charset = "UTF-8">
    </head>
    <body>	
        <h1>Login</h1>
        
        <form action = "<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method = "POST">
            <label for = "usuario">Usuario</label> 
            <input name = "usuario" type = "text">				

            <label for = "clave">Clave</label> 
            <input name = "clave" type = "password">			

            <input type = "submit" name="enviar" value="Enviar">
        </form>
<?= $mensaje ?>
    </body>
</html>
