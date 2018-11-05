<?php 
require_once "conector.php";
$resultado=$conexion->query("select tb1.nombre,tb1.tipo,tb2.nroinm from (select proyectos.id as idp,proyectos.nombre,tipos_inmueble.id as idt,tipos_inmueble.tipo from proyectos,tipos_inmueble) as tb1 left join (select proyectos_id,tipos_inmueble_id,COUNT(*) as nroinm from inmuebles GROUP BY proyectos_id,tipos_inmueble_id) as tb2 on tb1.idp= tb2.proyectos_id and tb1.idt=tb2.tipos_inmueble_id order by nombre,tipo");
$resultado2=$conexion->query("select tipo from tipos_inmueble order by tipo");
$tabla=array();
$columnas=array();
$columnas[]=array("label"=>"Proyecto","type"=>"string");
while($regcols=$resultado2->fetch_row()){
	$columnas[]=array("label"=>$regcols[0],"type"=>"number");
}
$tabla["cols"]=$columnas;
$filas = array();
$proy="";
$cont=0;
while($registros=$resultado->fetch_assoc()){
	$cont++;
	if($proy!=$registros["nombre"]){
		if($cont>1){
				$filas[]=array("c"=>$unafila);
				$cont=1;
		}
		$unafila=array();
		$unafila[]=array("v"=>(string)$registros["nombre"]);
		$unafila[]=array("v"=>(int)$registros["nroinm"]);
		$proy=$registros["nombre"];
	}
	else
		$unafila[]=array("v"=>(int)$registros["nroinm"]);
}
$tabla["rows"]=$filas;
$tabla_jason=json_encode($tabla);
echo $tabla_jason;
mysqli_close($conexion);
?>