<?php

$hostname = "localhost"; 
$username = "root"; 
$password = "canelA2006."; 
$database = "blogmusica";


$conexion = mysqli_connect( $hostname, $username, $password, $database );

if (mysqli_connect_errno()) {
    error_log("Error en la conexión: " . mysqli_connect_error());
} else {
    error_log("Conexión exitosa");
}

?>