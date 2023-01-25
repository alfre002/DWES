<?php

// cojo nº filas
$filas = $_POST['filas'];

?>

<html>
    <head>
        <meta charset="utf-8">
    </head>
    
    <body>
        
        <table border="1">
            <?php for($i = 0; $i < $filas; $i++): ?>
            <tr>
                <td><?= $i + 1 ?></td>
            </tr>
            <?php endfor ?>
        </table>
        
    </body>
</html>