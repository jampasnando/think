<?php
$conexion=new mysqli("localhost","jampasna_ptaang","admin123","jampasna_think");
if (mysqli_connect_errno()) {
    printf("Fallo de conexion: %s\n", mysqli_connect_error());
    exit();
}
?>