<?php
$id=$_REQUEST["id"];
require_once "conector.php";
$conexion->query("delete from tipos_inmueble where id='$id'");
mysqli_close($conexion);
?>