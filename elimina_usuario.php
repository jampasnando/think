<?php
$id=$_REQUEST["id"];
require_once "conector.php";
$conexion->query("delete from usuarios where id='$id'");
mysqli_close($conexion);
?>