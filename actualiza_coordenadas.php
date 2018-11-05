<?php
$lat=$_REQUEST["lat"];
$lon=$_REQUEST["lon"];
$id_proy=$_REQUEST["id_proy"];
require_once "conector.php";
if($conexion->query("update proyectos set latitud='$lat',longitud='$lon' where id='$id_proy'")){
	echo "exito";
}
else{
	echo "Error al cambiar esquema, vuelva a intentarlo";
}

mysqli_close($conexion);
?>
