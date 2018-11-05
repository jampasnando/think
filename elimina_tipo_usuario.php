<?php
$id=$_REQUEST["id"];
require_once "conector.php";
$conexion->query("delete from tipos_usuario where id='$id'");
mysqli_close($conexion);
?>