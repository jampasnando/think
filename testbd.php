<?php 
require_once "conector.php";
$r=$conexion->query("show columns from estados_proyecto");
$registro=$r->fetch_row();
echo $registro[0]."<br>";
echo $registro[1];
mysqli_close($conexion);
?>