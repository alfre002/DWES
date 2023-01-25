<?php

/* Partiendo de la BD dwes se trata de programar una aplicación que permita
gestionar los registros de la tabla 'productos'. La aplicación se dividirá en
tres páginas web (usa plantilla y CSS):
▫ listado.php: Mostrará un cuadro desplegable que permita seleccionar un
registro de la tabla 'familias', junto a un botón "Mostrar". Al pulsar el
botón, se mostrará un listado de los productos de la familia
seleccionada. Para cada producto se mostrará su nombre corto y su PVP,
junto a un botón con el texto "Editar" (una opción es crear un formulario
distinto por cada producto). Cuando se pulse ese botón, se enviará el
formulario a la página "editar.php".
▫ editar.php: Debe mostrar los datos del producto seleccionado en la página
anterior (nombre corto, nombre, descripción y PVP) dentro de un
formulario que permita cambiarlos, y dos botones: "Actualizar" y
"Cancelar". El formulario se enviará a la página "actualizar.php".
▫ actualizar.php: Esta página simplemente redirige a la página
"listado.php", pero si en el formulario anterior se ha pulsado
"Actualizar" (y no "Cancelar"), antes de redirigir debe ejecutar una
consulta para cambiar los datos del producto.
 */

// Declaramos variables para la conexion
$host = '127.0.0.1';
$usuario = 'dwes';
$password = 'abc123.';
$bd = 'dwes';
$pintar = false;
$mensaje = "";

// probar conexión
$cadenaConexion = "mysql:dbname=$bd;host=$host";
try {
    $bd = new PDO($cadenaConexion, $usuario, $password);
    echo 'conectado';
} catch (Exception $ex) {
    echo 'No se ha realizado la conexión';
    exit;
}

// consulta de la tabla familias
$consultaFamilia = "select cod as codFamilia, nombre as nombreFamilia from familia";
$familia = $bd->query($consultaFamilia);

// recoger código de la familia
if(isset($_POST['codFamiliaSelect'])) {
    $codFamilia = $_POST['codFamiliaSelect'];
}

// comprobar si se ha pulsado el botón mostrar
if(isset($codFamilia)) {
    // consulta productos
    $queryProducto = "select cod as codProd, nombre_corto, PVP, nombre, descripcion from producto"
            . " where familia = '" . $codFamilia . "'";
    
    // ejecutamos la consulta
    $consultaFinal = $bd->query($queryProducto);
    
    // comprobamos si se ha realizado la consulta
    if($consultaFinal) {
        $precio = $consultaFinal->fetchAll();
    }
    
    // comprobar si la tabla recoge datos
    if(count($precio) == 0) {
        $mensaje = 'No hay datos.';
    } else {
        $pintar = true;
    }
}

// si viene del botón cancelar
    if(isset($_REQUEST['resultado'])) {
        if($_REQUEST['resultado'] == 'cancelar') {
            $mensaje = 'Se ha cancelado la operación.';
        } elseif($_REQUEST['resultado'] == 'actualizar') {
            $mensaje = 'Se ha actualizado el producto correctamente.';
        }
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
	<h1>Listado </h1>
	<form id="form_seleccion" action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
            <label>Familia</label>
            
            <select name="codFamiliaSelect">
                <?php foreach ($familia as $value): ?>
                
                <?php if($codFamilia==$value['codFamilia']): ?>"
                
                <!<!-- Para que se quede seleccionada la que ya está -->
                <option value="<?= $value["codFamilia"] ?>" selected>
                    <?= $value["nombreFamilia"] ?>
                </option>
                
                <?php else: ?>
                    <option value="<?= $value["codFamilia"] ?>">
                        <?= $value["nombreFamilia"] ?>
                    </option>
                <?php endif; ?>
                
                <?php endforeach; ?>
            </select>
            
            <input type="submit" name= "mostrar" value="Mostrar"/>
            
        </form>
</div>

<div id="contenido">
    <?php if ($pintar): ?>  
    
    <?php foreach ($precio as $value): ?>

        <form method="post" action="editar.php">
            
            <table>
                <tr>
                    <th>Producto</th>
                    <th>PVP</th>
                </tr>
                
                <tr>
                    <td><?= $value['nombre_corto'] ?></td>
                    <td><?= $value['PVP'] ?></td>
                </tr>
                
                <tr>
                    <td colspan="2">
                        <!<!-- Enviar datos ocultos a la página editar -->
                        <input type="hidden" name="codFamiliaSelect" value="<?= $codFamilia ?>">
                        <input type="hidden" name="codProd" value="<?= $value['codProd'] ?>">
                        <input type="hidden" name="nombreProd" value="<?= $value['nombre'] ?>">
                        <input type="hidden" name="nombreCorto" value="<?= $value['nombre_corto'] ?>">
                        <input type="hidden" name="PVP" value="<?= $value['PVP'] ?>">
                        <input type="hidden" name="descripcion" value="<?= $value['descripcion'] ?>">
                        <input type="submit" name="editar" value="Editar">
                    </td>
                </tr>
            </table>       
                          
        </form>
    
    <?php endforeach ?>
    
    <?php else: ?>
        <?= $mensaje ?>
    <?php endif ?>
</div>

<div id="pie">
</div>
</body>
</html>