<?php

//variables para la conexion
$usuario= 'dwes';
$contraseña= 'abc123.';
$host = '127.0.0.1';
$base_datos = 'dwes';
$pintar=false;
$nohaydatos = null;
$cod_prod = null;
$arraynombreproducto = null;
$mensaje = "";

//conexion
$cadena_conexion = "mysql:dbname=$base_datos;host=$host";
try {
    $conexionbd= new PDO($cadena_conexion, $usuario, $contraseña);
    echo 'conectado';
} catch (Exception $ex) {
    echo 'no ha entrado churra';
    exit;
}

$sql = "select nombre, cod from producto";
$stock1 = $conexionbd->query($sql);

    if(isset($_POST['cod_prod'])) {
        $cod_prod = $_POST['cod_prod'];
    }
    
    // comprobar si se ha pulsado el boton modificar cojones
   if (isset($_POST["actualizar"])){
       
       $unidades_modificadas = $_POST["modificar"];
       $tienda_modificada = $_POST["tienda_modificada"];
                     
        // consulta de actualizar
        $update = "UPDATE stock"
                . " SET unidades = ? "
                . " WHERE producto = '" . $cod_prod . "'"
                . " AND tienda = ?";
        
        // hacemos consulta preparada
        $resultado_update = $conexionbd->prepare($update);
        
        for($i=0; $i < count($tienda_modificada); $i++) {
            $resultado_update->execute(array($unidades_modificadas[$i], $tienda_modificada[$i]));
        }
        // actualizar datos y mostrarlos
        $resultado = $resultado_update->fetchAll();
    
   }
    
//para ver si has pulsado el botoncito
if(isset($cod_prod)){
    
    //Sacamos la consulta de los nombre de las tiendas, bb
    $nombre_tienda= "select producto.nombre as nombre_producto, tienda.nombre as tienda_modificada,"
            . " stock.unidades, tienda.cod as cod_tienda from tienda"
            . " inner join stock on tienda.cod = stock.tienda"
            . " inner join producto on producto.cod = stock.producto"
            . " where stock.producto = '".$cod_prod."'";
   
    //ejecutamos la consulta de los cojones
    $consultanomund = $conexionbd ->query($nombre_tienda);
   
    //comprobamos si se ha hecho la consulta, mi vida
    if($consultanomund){
        $stock = $consultanomund->fetchAll(PDO::FETCH_ASSOC);
    }
   
//si hay dtos me pinta la tabla sino me da el error
   
    if (count($stock)==0) {
        $mensaje= "no hay datos.";
       
    }else{
        $pintar=true;
   }   
}

?>

<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <link href="dwes.css" rel="stylesheet" type="text/css">
    </head>
    <body>
        <div id="encabezado">
       
        <!-- Formulario, rey !-->
       
       <!-- pa que me pinte el array si tiene errores
        <pre> <?php print_r($stock)?></pre> !-->
       
         <h1>Ejercicio: </h1>
            <form id="form_seleccion" action="<?php echo $_SERVER['PHP_SELF'];
            ?>" method="post">
                <label>Productos</label>
               
                 <!-- Para selecionar el producto que queramos !-->
                <select name="cod_prod">
                 <?php foreach ($stock1 as $value): ?>
                    <option value="<?= $value["cod"] ?>">
                        <?= $value["nombre"] ?>
                    </option>
                     <?php endforeach; ?>            
                </select>
                 
                <input type="submit" name= "enviar" value="Enviar"/>
            </form>
         
         </div>
        
        <div id="contenido">
             
           <?php if ($pintar): ?>     
           
         <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">               
                         
             <?php foreach ($stock as $value) : ?>
                   
             <p>Tienda: <?= $value['tienda_modificada']?></p> 
             <p>Unidades: </p>
             
             <input
                 type="text"
                 name="modificar[]"
                 value="<?= $value['unidades']?>"/>
             
             <input
                 type="hidden"
                 name="tienda_modificada[]"
                 value="<?= $value['cod_tienda']?>"/>
             
             <?php endforeach ?>
             
             <input type="hidden" name="cod_prod" value="<?=$cod_prod?>">
             <input type="submit" name="actualizar" value="Actualizar">
                 
        </form> 
         
       <?php else: ?>
            <?=$mensaje?>
       <?php endif ?>
            
        </div>
                
    </body>
</html>