<?php

require_once './funciones.php';

try {
    $mensaje = '';
    comprobrar_sesion();
    
    // errores
    if($_REQUEST['error']) {
        if($_REQUEST['error'] == 'vacio') {
            $mensaje = 'No ha escrito nada.';
        } elseif($_REQUEST['error'] == 'error1') {
            $mensaje = 'No ha escrito una sola palabra con letras y números.';
        }
    }
} catch (Exception $ex) {
    $mensaje = $ex->getMessage();
}

?>

<html>
    <head>
<link rel="stylesheet" href="error.css"/>
    </head>

    <body>
        <div>
            <form action='sesiones4.php' method='post'>
                <fieldset >
                    <legend>Sesiones 3</legend>
                    <div><span class='error'><?= $mensaje ?></span></div>
                    <h2>Repita la palabra:</h2>
                    <div class='campo'>
                        <label for='palabra2' >Palabra: </label><br/>
                        <input type='text' name='palabra2' id='palabra2' maxlength="20" /><br/>
                    </div>

                    <div class='campo'>
                        <input type='submit' name='siguiente' value='Siguiente' />
                        <input type='submit' name='borrar' value='Borrar' />
                    </div>
                </fieldset>
            </form>
        </div>
    </body>
</html>