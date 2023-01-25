<?php ?>

<html>
    <head>

    </head>

    <body>
        <div id='login'>
            <form action='<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?>' method='post'>
                <fieldset >
                    <legend>Login</legend>
                    <div><span class='error'><?= $mensaje ?></span></div>
                    <div class='campo'>
                        <label for='usuario' >Usuario:</label><br/>
                        <input type='text' name='usuario' id='usuario' maxlength="50" /><br/>
                    </div>
                    <div class='campo'>
                        <label for='password' >Contraseña:</label><br/>
                        <input type='password' name='password' id='password' maxlength="50" /><br/>
                    </div>

                    <div class='campo'>
                        <input type='submit' name='enviar' value='Enviar' />
                    </div>
                </fieldset>
            </form>
        </div>
    </body>
</html>