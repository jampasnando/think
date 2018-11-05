<?php
session_start();
require_once "conector.php";
$idproyecto=$_REQUEST["idproyecto"];
$resultado=$conexion->query("select id from inmuebles where proyectos_id='$idproyecto'");
$unregistro=$resultado->fetch_row();
$idinmueble=$unregistro[0];
//echo $idproyecto."--".$idinmueble;

$conexion->query("delete ambientes_propios_inmueble from ambientes_propios_inmueble inner join (select * from inmuebles where proyectos_id='$idproyecto') as tb1 on ambientes_propios_inmueble.inmuebles_id=tb1.id");
$conexion->query("delete from inmuebles where proyectos_id='$idproyecto'");
$conexion->query("delete from proyectos where id='$idproyecto'");
?>