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

/* $sql = "Insert into usuarios Values (null, 'Esteban', 'Gomez', 'esteban@gmail.com', '12345', '2025-03-11' )";

$insert = mysqli_query($conexion, $sql); */

?>