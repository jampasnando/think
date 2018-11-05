<?php
$id_reg=$_REQUEST["id_reg"];
$esquema=$_REQUEST["esquema"];
require_once "conector.php";
if($conexion->query("update estados_inmueble set color='$esquema' where id='$id_reg'")){
	echo "exito";
}
else{
	echo "Error al cambiar esquema, vuelva a intentarlo";
}

mysqli_close($conexion);
?>
