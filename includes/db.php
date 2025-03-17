<?php
$hostname = "localhost"; 
$username = "root"; 
$password = ""; 
$database = "blogmusica";


$conexion = mysqli_connect( $hostname, $username, $password, $database );

if(mysqli_connect_errno()){
    echo "error en la conexion".mysqli_connect_error();
}else{
    echo "Conexion exitosa";
}

?>