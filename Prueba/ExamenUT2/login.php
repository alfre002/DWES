<?php
/* Si el login introducido coincide con “user01” y la password con “iesmm2223”,
  se mostrará un mensaje (en verde) con su nombre dando la bienvenida al
  usuario (por ejemplo: “Bienvenido user01”).
  ▪ En caso contrario, en la misma página se mostrará un mensaje de error (en
  rojo). Se podrán dar tres mensajes de error distintos:
  ▫ “Debes introducir un nombre de usuario y una contraseña”, si se deja en
  blanco el login o la password.
  ▫ “El nombre de usuario es incorrecto”, si se pasa un login inexistente.
  ▫ Se mostrará “Contraseña incorrecta” en el caso de que el login
  introducido sí sea correcto, pero no coincida la password asociada. */

$usuariosValidos = ['user01' => '1', 'user02' => '2', 'user03' => '3', 'user04' => '23'];
$clase = null;
$mensaje = '';

if (isset($_POST['enviar'])) {
    $usuario = $_POST['login'];
    $contraseña = $_POST['password'];

    if (array_key_exists($usuario, $usuariosValidos) && $contraseña == $usuariosValidos[$usuario]) {
        $mensaje = "Bienvenido $usuario.";
        $clase = "verde";
    } elseif ($usuario == '' || $contraseña == '') {
        $mensaje = "Debe introducir un usuario y una contraseña.";
        $clase = "rojo";
    } elseif (!array_key_exists($usuario, $usuariosValidos)) {
        $mensaje = "Usuario incorrecto.";
        $clase = "rojo";
    } else {
        $mensaje = "Contraseña incorrecta.";
        $clase = "rojo";
    }
}
?>

<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Formulario edad</title>
        <style>
            h2{
                text-align:center;
            }

            table{
                background-color:#FFC;
                padding:5px;
                border:#666 5px solid;
            }

            .rojo{
                font-size:18px;
                color:#F00;
                font-weight:bold;
                text-align:center;

            }

            .verde{
                font-size:18px;
                color:#0C3;
                font-weight:bold;
                text-align:center;
            }


        </style>
    </head>

    <body>
        <h2>INTRODUCE TUS CREDENCIALES</h2>

        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" name="datos_usuario" id="datos_usuario">
            <table width="15%" align="center">
                <tr>
                    <td>Usuario:</td>
                    <td><label for="Usuario"></label>
                        <input type="text" name="login" id="login"></td>
                </tr>
                <tr>
                    <td>Contraseña:</td>
                    <td><label for="Contraseña"></label>
                        <input type="password" name="password" id="password"></td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <td class="<?=$clase?>">
                        <?= $mensaje ?>
                    </td>
                    <td colspan="2" align="center"><input type="submit" name="enviar" id="enviar" value="Enviar"></td>
                </tr>
            </table>
        </form>

        <?php
        ?>

    </body>
</html>