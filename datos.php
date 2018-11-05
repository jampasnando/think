<?php 
require_once "conector.php";
$resultado=$conexion->query("SELECT proyectos.nombre,count(*) as nro_inm FROM inmuebles inner join proyectos on inmuebles.proyectos_id=proyectos.id group by proyectos_id");
$tabla=array();
$tabla["cols"]=array(array("label"=>"Proyecto","type"=>"string"),array("label"=>"Nro_Inm","type"=>"number"),array("type"=>"string","role"=>"annotation"));
$tabla_jason=json_encode($tabla);
//echo $tabla_jason;
$filas = array();
while($registros=$resultado->fetch_assoc()){
	$unafila=array();
	$unafila[]=array("v"=>(string)$registros["nombre"]);
	$unafila[]=array("v"=>(int)$registros["nro_inm"]);
	$unafila[]=array("v"=>$registros["nro_inm"]);
	$filas[]=array("c"=>$unafila);
}
$tabla["rows"]=$filas;
$tabla_jason=json_encode($tabla);
echo $tabla_jason;
mysqli_close($conexion);
?>