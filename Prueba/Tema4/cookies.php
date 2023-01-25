<?php

if(!isset($_COOKIE['contador'])){
	setcookie('contador', '1', time() + 3600 * 24);
	echo "Bienvenido por primera vez";
} else {
	$contador = (int) $_COOKIE['contador'];
	$contador++;
	setcookie('contador', $contador, time() + 3600 * 24);
	echo "Bienvenido por $contador vez";
}


?>
