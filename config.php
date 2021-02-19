<?php
/* Credenciales de base de datos. Suponiendo que está ejecutando MySQL
servidor con configuración predeterminada (usuario 'root' sin password) */

define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'demo');

/* Intento de conectarse a la base de datos MySQL */
$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

// Comprueba informacion
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
?>
