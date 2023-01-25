<?php

    // si recibe datos de listado, guarda los datos en variables
    if(isset($_POST['editar'])) {
        $mensaje = 'Se han recibido los siguientes datos.';
        $nombreCorto = $_POST['nombreCorto'];
        $nombreProd = $_POST['nombreProd'];
        $descripcion = $_POST['descripcion'];
        $PVP = $_POST['PVP'];
        $codProd = $_POST['codProd'];
        $pintar = true;
    } else {
        $mensaje = "No se ha recibido nada, vaya a la página de listado.";
        $pintar = false;
    }

?>

<html>
<head>
  <meta http-equiv="content-type" content="text/html; charset=UTF-8">
  <title>Plantilla para Ejercicios Tema 3</title>
  <link href="dwes.css" rel="stylesheet" type="text/css">
</head>

<body>

<div id="encabezado">
	<h1>Editar </h1>
</div>

<div id="contenido">
    <!-- Solo pinta si se han recibido datos de listado -->
    <?php if($pintar): ?>
    
    <!-- Tabla para los datos del producto que se quiere editar -->
    <?= $mensaje . "<br><br>" ?>
    
    <form method="post" action="actualizar.php">
    
        <table>
            <tr>
                <th>Producto</th>
                <th>Nombre Corto</th>
                <th>Descripción</th>
                <th>PVP</th>
            </tr>

            <tr>
                <td><input type="text" name="nombreProducto" value="<?= $nombreProd ?>"></td>
                <td><input type="text" name="nombreCorto" value="<?= $nombreCorto ?>"></td>
                <td><input type="text" name="descripcion" value="<?= $descripcion ?>"></td>
                <td><input type="text" name="PVP" value="<?= $PVP ?>"></td>
            </tr>
        </table>
        
        <input type="submit" name="actualizar" value="Actualizar">
        <input type="submit" name="cancelar" value="Cancelar">
        
        <!-- Envío oculto el código del producto -->
        <input type="hidden" name="codProd" value="<?= $codProd ?>">
        
    </form>
    
    <?php else: ?>
        <?= $mensaje ?><br><br>
        <a href="listado.php">Listado</a>
    <?php endif ?>
    
</div>

<div id="pie">
</div>
</body>
</html>
