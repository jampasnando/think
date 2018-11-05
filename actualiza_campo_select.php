<?php 
require_once "conector.php";
$id=$_REQUEST["id"];
$colu=$_REQUEST["colu"];
$nuevovalor=$_REQUEST["nuevovalor"];
$tabla_bd=$_REQUEST["tabla_bd"];
$nuevotexto=$_REQUEST["nuevotexto"];
//$consulta="show columns from ".$tabla_bd;
$resultado=$conexion->query("show columns from $tabla_bd");
while($unafila=$resultado->fetch_row()){
	$campos[]=$unafila[0];
}
$campo=$campos[$colu];
$sql="update $tabla_bd set $campo='$nuevovalor' where id='$id'";
$conexion->query($sql);
if($conexion)
	echo $nuevotexto;
else
	echo "ERROR AL ACTUALIZAR, REFRESQUE LA PÁGINA Y VUELVA A INTENTAR";
mysqli_close($conexion);
?>