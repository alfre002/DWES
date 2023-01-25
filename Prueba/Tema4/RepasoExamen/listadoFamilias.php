<?php

require_once './funciones.php';

// comprobamos si existe una sesión
comprobarSesion();
        
try {
    // conexión bd
    $conexion = conexion();
    $mensaje = null;
    
    // consulta de las familias
    $consulta = "SELECT * FROM familia";
    $familias = $conexion->query($consulta);
    
} catch (Exception $e) {
    $mensaje = "Error: " . $e->getMessage();
}

?>

<html>
<head>
  <meta http-equiv="content-type" content="text/html; charset=UTF-8">
  <title>Listado Familia Tienda</title>
  <link href="tienda.css" rel="stylesheet" type="text/css">
</head>

<body>
    <div>
    <form action='<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?>' method='post'>
    <fieldset >
        <legend>Listado Familias</legend>
        <div><span class='error'><?= $mensaje ?></span></div>
        <ul>
        <?php foreach($familias as $value): ?>
            <li>
                <a href="listadoProductos.php?familia=<?=$value['cod']?>"> <?= $value['nombre'] ?> </a>
            </li> 
        <?php endforeach; ?>
        </ul>
    </fieldset>
    </form>
    </div>
</body>
</html>