<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01
    Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">

<?php
//Declaramos variables para la conexión
$host = '127.0.0.1';
$usuarioBd = 'dwes';
$password = 'abc123.';
$nombreBd = 'dwes';
$nombre_producto_selec = null;
$cod_prod = null;

// recogemos el codigo del producto enviado o modificado
if (isset($_POST["cod_prod"])) {
    $cod_prod = $_POST['cod_prod'];
}

//Creamos mensaje
$mensaje='mensaje no editado';

//Creamos la conexión con la BD usando atributos
/* Primera forma de hacerlo:
 * 
  $conexion = new mysqli();
  $conexion-> mysqli_connect($host, $usuarioBd, $password, $nombreBd );

 * Mejor forma de hacerlo (Lo hacemos dentro de un try catch: */

//Vemos si ha ocurrido un error
try {
    $bd = new mysqli($host, $usuarioBd, $password, $nombreBd);
} catch (Exception $e) {
    die('<p>Error conexión: ' . $e->getMessage() . '</p>');
}

// comprobamos si se ha pulsado el boton modificar
if(isset($_POST["modificar"])){
    // recogemos valores
    $unidadesModificadas = $_POST["unidades"];
    $tiendasModificadas = $_POST["tiendas"];
    
    $consultaPreparada = $bd ->stmt_init();
    
    // consultas 
    $query = "UPDATE stock SET unidades = ? WHERE producto = '";
    $query .= $cod_prod . "' and tienda = ?";
    $consultaPreparada ->prepare($query);
    for($i = 0; $i < count($tiendasModificadas); $i++) {
        $consultaPreparada ->bind_param('ii', $unidadesModificadas[$i], $tiendasModificadas[$i]);
        $consultaPreparada ->execute();
    }
}

//Comprobamos si se ha metido algun codigo de producto
if(isset($cod_prod)){
  
  // consulta del stock
  $consulta_stock = "SELECT tienda.nombre, stock.unidades, tienda.cod as cod_tienda FROM stock"
          . " INNER JOIN tienda ON stock.tienda=tienda.cod "
          . "WHERE stock.producto='". $cod_prod. "'";
  
  $resultado_stock= $bd->query($consulta_stock);
  
  if ($resultado_stock){
      $stock=$resultado_stock->fetch_all(MYSQLI_ASSOC);
  }
  
}

//Crear la consulta
$query = 'SELECT cod, nombre FROM producto';

$resultado = $bd->query($query);  //puede devolver false si no se conecta, o un objeto de la clase mysqli_use_result

if ($resultado) {
    $productos = $resultado->fetch_all(MYSQLI_ASSOC);   //devuelve todas las filas, array asociativo (fetch solo devuelve una fila)
    
    //Para sacar el nombre del producto a partir del codigo seleccionado
    foreach ($productos as $value) {
        if ($value["cod"]==$cod_prod){
            $nombre_producto_selec = $value["nombre"];
        }
    }
    
}else{
    $mensaje="La consulta no se ha realizado correctamente";
}

?>
<html>
    <head>
        <meta http-equiv="content-type" content="text/html;
              charset=UTF-8">
        <title>Plantilla para Ejercicios Tema 3</title>
        <link href="dwes.css" rel="stylesheet" type="text/css">
    </head>
    <body>
        <!-- <pre> <?php //print_r($productos)?></pre> Con la etiqueta <pre> te formatea la salida del array-->
        <div id="encabezado">
            <h1>Ejercicio: </h1>
            <form id="form_seleccion" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                <label>Productos</label>
                <select name="cod_prod">
                    <?php foreach ($productos as $value):?>
                       <?php if($cod_prod==$value["cod"]) :?>    <!--para ver si he enviado el formulario, mostrar el producto que he enviado-->
                            <option value="<?= $value["cod"] ?>" selected> <?=$value["nombre"]?> </option>
                        <?php else:?>
                            <option value="<?= $value["cod"] ?>"> <?=$value["nombre"]?> </option>
                        <?php endif?>
                    <?php endforeach?>
                </select>
                <input type="submit" name= "enviar" value="Enviar"/>
            </form>
        </div>
        <div id="contenido">
            <h2>Stock del producto <?=$nombre_producto_selec?> en las tiendas</h2>
            
            <?php if (isset($cod_prod) && count($stock) != 0): //Si tengo código enviado?>
       
            <?php print_r($stock)?>
            
            <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                
                <?php foreach ($stock as $value):?>
                    
                    <p>Tienda <?=$value["nombre"]?>:<input type="text" name="unidades[]" value="<?=$value["unidades"]?>"></p>
                    <input type="hidden" name="tiendas[]" value="<?=$value["cod_tienda"]?>">
                <?php endforeach;?>
                    <input type="hidden" name="cod_prod" value="<?=$cod_prod?>">
                    <input type="submit" name="modificar" value="Modificar">
            </form>
            <?php elseif (isset($stock) && count($stock) == 0):?>
            <p>No hay stock de este producto.</p>
            <?php endif ?>
        </div>
        <div id="pie">
        </div>
    </body>
</html>

