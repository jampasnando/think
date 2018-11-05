<?php
$id_proy=$_REQUEST["id_proy"];
$ultimo=$_REQUEST["ultimo"];
$nuevafila=$ultimo + 1;
require_once "conector.php";
$conexion->query("update proyectos set textofilas=concat('$nuevafila',':',textofilas) where id='$id_proy'");
$conexion->query("update inmuebles set posfila=posfila+1 where proyectos_id='$id_proy'");
mysqli_close($conexion);
?>