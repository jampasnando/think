<?php
$id_proy=$_REQUEST["id_proy"];
$borrar=$_REQUEST["borrar"];
$pos=$_REQUEST["pos"];
require_once "conector.php";
$conexion->query("update proyectos set textocols=replace(trim(':' from replace(textocols,'$borrar','')),'::',':') where id='$id_proy'");
$conexion->query("delete from inmuebles where poscol='$pos' and proyectos_id='$id_proy'");
$conexion->query("update inmuebles set poscol=poscol-1 where poscol>'$pos' and proyectos_id='$id_proy'");

mysqli_close($conexion);
?>