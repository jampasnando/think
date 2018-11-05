<?php
$id=$_REQUEST["id"];
require_once "conector.php";
$conexion->query("delete from ambientes_propios where id='$id'");
mysqli_close($conexion);
?>