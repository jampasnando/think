<?php 
require_once "conector.php";
$id_proy=$_REQUEST["id_proy"];
$conexion->query("update proyectos set latitud='',longitud='' where id='$id_proy'");
mysqli_close($conexion);
?>