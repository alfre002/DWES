<?php

$idioma = 'esp';

if(isset($_POST['enviar_idioma'])) {
    $idioma = $_POST['idioma'];
    setcookie('idioma', $idioma, time() + 3600 * 24);
} else {
    if(isset($_COOKIE['idioma'])) {
        $idioma = $_COOKIE['idioma'];
    }
}

?>

<html>
    <head>
        <meta charset="UTF-8">
    </head>
    
    <body>
        <h1>SELECCIONA EL IDIOMA DE LA WEB</h1>
        <form action="cookies.php" method="post">
            <select name="idioma">
                <?php if(isset($idioma) && $idioma === 'esp'): ?>
                    <option value="esp" selected>Español</option>
                    <option value="eng">Inglés</option>
                <?php elseif(isset($idioma) && $idioma === 'eng'): ?>
                    <option value="esp">Español</option>
                    <option value="eng" selected>Inglés</option>
                <?php endif; ?>
            </select>
            <input type="submit" name="enviar_idioma>" value="Enviar">
        </form>
        
        <?php if($idioma === 'esp'): ?>
        <h1>Hola</h1>
        <?php elseif($idioma === 'esp'): ?>
        <h1>Hello</h1>
        <?php endif; ?>
    </body>
</html>