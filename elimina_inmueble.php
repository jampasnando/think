<?php
$id_inm=$_REQUEST["id_inm"];
$proy=$_REQUEST["proy"];
require_once "conector.php";
$conexion->query("delete from ambientes_propios_inmueble where inmuebles_id='$id_inm'");
$conexion->query("delete from inmuebles where id='$id_inm'");
mysqli_close($conexion);
?>