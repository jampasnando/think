<?php
$id=$_REQUEST["id"];
require_once "conector.php";
$conexion->query("delete from areascomunes where id='$id'");
mysqli_close($conexion);
?>