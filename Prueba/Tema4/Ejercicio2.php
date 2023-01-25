<?php 
/* Crea una página web con un formulario para elegir el idioma en el que se muestra, inglés o español.
  Almacena la elección del usuario con una cookie para que la siguiente vez que el usuario se conecte la página aparezca directamente en su idioma.
  Si la cookie no existe, la página se mostrará en español.
 */

// idioma por defecto
$idioma = "esp";

// comprobar si se ha accedido por 1ª vez
if (isset($_POST['enviar'])) {
    // guardo el idioma seleccionado al pulsar enviar y lo guardo en una cookie
    $idioma = $_POST['idioma'];
    setcookie('idioma', $idioma, time() + 3600 * 24);
} else {
    // si no se ha enviado comprobrar si hay alguna cookie
    if (isset($_COOKIE['idioma'])) {
        $idioma = $_COOKIE['idioma'];
    }
}
?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <title>HTML</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="estilo.css">
    </head>

    <body>
        <form action="<?= $_SERVER['PHP_SELF'] ?>" method="post">
            <select name="idioma">
                <option value="esp">Español</option>
                <option value="ing">Inglés</option>
                <option value="fra">Francés</option>
                <input type="submit" name="enviar" value="Enviar">
            </select>
        </form>

        <?php if ($idioma == 'ing'): ?>
            <h2>Hello</h2>
        <?php elseif ($idioma == 'esp'): ?>
            <h2>Hola</h2>
        <?php elseif ($idioma == 'fra'): ?>
            <h2>Bonjour</h2>
        <?php endif ?>
    </body>
</html>