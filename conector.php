<?php
$conexion=new mysqli("localhost","root","","think");
if (mysqli_connect_errno()) {
    printf("Fallo de conexion: %s\n", mysqli_connect_error());
    exit();
}
?>