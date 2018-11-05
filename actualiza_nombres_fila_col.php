<?php
$id_proy=$_REQUEST["id_proy"];
$cadenafilas=$_REQUEST["cadenafilas"];
$cadenacols=$_REQUEST["cadenacols"];
require_once "conector.php";
//$conexion->query("update proyectos set textofilas='$cadenafilas',textocols='$cadenacols' where id='$id_proy'");
$conexion->query("update proyectos set textofilas='$cadenafilas' where id='$id_proy'");
mysqli_close($conexion);
?>