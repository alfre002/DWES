<?php

require_once './funciones.php';

try {
    $mensaje = '';
    comprobrar_sesion();
    
    // errores
    if(isset($_REQUEST['error'])) {
        if($_REQUEST['error'] == 'vacio') {
            $mensaje = 'No puedo estar vacío.';
        } elseif($_REQUEST['error'] == 'espacio') {
            $mensaje = 'Debe ser una única palabra con letras y números.';
        } elseif($_REQUEST['error'] == 'noiguales') {
            $mensaje = 'Las palabras no coinciden, pruebe de nuevo.';
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
            <form action='sesiones2.php' method='post'>
                <fieldset >
                    <legend>Sesiones 1</legend>
                    <div><span class='error'><?= $mensaje ?></span></div>
                    <h2>Escribe una palabra (Mayúsculas, Minúsculas y Números:</h2>
                    <div class='campo'>
                        <label for='palabra' >Palabra: </label><br/>
                        <input type='text' name='palabra' id='palabra' maxlength="20" /><br/>
                    </div>

                    <div class='campo'>
                        <input type='submit' name='siguiente' value='Siguiente' />
                        <input type='reset' name='borrar' value='Borrar' />
                    </div>
                </fieldset>
            </form>
        </div>
    </body>
</html>