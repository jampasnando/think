<?php
$id_inm=$_REQUEST["id_inm"];
$id_estado=$_REQUEST["id_estado"];
require_once "conector.php";
$conexion->query("update inmuebles set estado='$id_estado' where id='$id_inm'");
$consulta=$conexion->query("select * from estados_inmueble where id='$id_estado'");
$registro=$consulta->fetch_row();
echo $registro[3];
mysqli_close($conexion);
?>
