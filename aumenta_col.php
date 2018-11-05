<?php
$id_proy=$_REQUEST["id_proy"];
require_once "conector.php";
$conexion->query("update proyectos set textocols=concat(textocols,':[SinNombre]') where id='$id_proy'");
mysqli_close($conexion);
?>