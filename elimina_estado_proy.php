<?php
$id=$_REQUEST["id"];
require_once "conector.php";
$conexion->query("delete from estados_proyecto where id='$id'");
mysqli_close($conexion);
?>