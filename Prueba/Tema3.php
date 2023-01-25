<?php
// comprobamos si se ha pulsado el boton enviar
if(isset($_POST["enviar"])) {
    // creamos variable para recoger el codigo del producto enviado en el formulario
    $cod_enviado = $_POST["cod_prod"];
    $consulta_stock = 'SELECT tienda.nombre, stock.unidades FROM stock'
            . 'INNER JOIN tienda ON (stock.tienda=tienda.cod)'
            . "WHERE stock.producto=$cod_enviado";
    
}

// variables con nuestros datos
$pasw = 'abc123.';
$host = 'localhost';
$user = 'dwes';
$bdatos = 'dwes'; 

// si hay error de conexion lo muestra
try{
   $bd = new mysqli($host, $user, $pasw, $bdatos); 
} catch (Exception $e) {
   die("Error de conexión: " . $e -> getMessage());
}

// consulta
$query = 'SELECT cod, nombre FROM producto';
$resultado = $bd -> query($query);
if($resultado) {
    $productos = $resultado -> fetch_all(MYSQLI_ASSOC); // fetch devuelve solo 1 fila 

} else{
    $mensaje = 'La consulta no se ha realizado correctamente.';
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
        <!-- <pre><?php //print_r($productos) ?></pre> !-->
        <div id="encabezado">
            <h1>Ejercicio: </h1>
            <form id="form_seleccion" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                <label> Productos </label>
                <select name="cod_prod">
                    <?php foreach ($productos as $value): ?>
                        <?php if($cod_enviado == $value["cod"]): ?> <!-- para ver si se ha enviado el formulario, mostrar el producto que ha enviado !-->
                            <option value="<?=$value["cod"]?>" selected><?=$value["nombre"]?></option>
                        <?php else: ?>
                            <option value="<?=$value["cod"]?>"><?=$value["nombre"]?></option>
                        <?php endif; ?>
                    <?php endForEach; ?>
                </select>
                <input type="submit" value="Enviar" name="enviar">
            </form>
        </div>
        <div id="contenido">
            <h2>Stock del producto en las tiendas</h2>
            <p>Código enviado: <?=$cod_enviado?></p>
        </div>
        <div id="pie">
        </div>
    </body>
</html>