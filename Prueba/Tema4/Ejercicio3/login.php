<?php
//variables para la conexion
$usuario = 'root';
$contraseña = 'Visoalcor1';
$host = '127.0.0.1';
$bd = 'tiendas';
$mensaje = "";

//conexion
$cadenaConexion = "mysql:dbname=$bd;host=$host";
try {
    $conexionbd = new PDO($cadenaConexion, $usuario, $contraseña);
    echo 'conectado';
    if (isset($_POST['enviar'])) {
        
        $usuario=$_POST['usuario'];
        $password=md5($_POST['password']);
        
        $consultaUsuario="SELECT usuario,password FROM usuarios WHERE usuario=:usuario and password=:password";
        $resultadoUsuario=$conexionbd->prepare($consultaUsuario);
        $parametros=[":usuario"=>$usuario,":password"=>$password];
        $resultadoUsuario->execute($parametros);
        
        if ($resultadoUsuario->rowCount()>0) {  
            
            session_start();
            $_SESSION['usuario']=$usuario;
            //hacer otra pagina
            header('Location:listadoFamilias.php');
    
        }else{
            $mensaje="Usuario o contraseña incorrecta";
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