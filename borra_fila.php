<?php
$id_proy=$_REQUEST["id_proy"];
$borrar=$_REQUEST["borrar"];
$pos=$_REQUEST["pos"];
require_once "conector.php";
$conexion->query("update proyectos set textofilas=replace(trim(':' from replace(textofilas,'$borrar','')),'::',':') where id='$id_proy'");
$conexion->query("delete from inmuebles where posfila='$pos' and proyectos_id='$id_proy'");
$conexion->query("update inmuebles set posfila=posfila-1 where posfila>'$pos' and proyectos_id='$id_proy'");

mysqli_close($conexion);
?>