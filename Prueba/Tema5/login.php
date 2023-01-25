<?php

require_once './DB.php';
require_once './funciones.php';
$mensaje = '';

try {
    if(isset($_POST['enviar'])) {
        $usuario = $_POST['usuario'];
        $password = $_POST['password'];
        if(DB::verificaCliente($usuario, $password)) {
            session_start();
            $_SESSION['usuario']=$usuario;
            header('Location:listadoFamilias.php');
        } else {
            $mensaje = "Usuario o Contraseña incorrecta.";
        }
    }
} catch (Exception $ex) {
    die($ex->getMessage());
    exit;
}

?>

<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <link href="tienda.css" rel="stylesheet" type="text/css">
    </head>
    <body>
        <div id="encabezado">
         <h1>Login</h1>   
        </div>
        <br>
        <div id="login">
            <form action = "<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method = "POST">
                <label for = "usuario">Usuario</label> 
                <input name = "usuario" type = "text">				

                <label for = "password">Clave</label> 
                <input name = "password" type = "password">			

                <input type = "submit" name="enviar" value="Enviar">
            </form>
            <?=$mensaje?>  
        </div>

    </body>
</html>