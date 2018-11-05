<?php 
session_start();
require_once "conector.php";
$nro_filas=$_REQUEST["nro_filas"];
$id_proy=$_REQUEST["id_proy"];
$nro_col=$_REQUEST["nro_col"];
for($k=1;$k<=$nro_filas;$k++){
	$id_inm=$_REQUEST["id_inm_".$k];
	$precio_i=$_REQUEST["i_".$k];
	$precio_g=$_REQUEST["g_".$k];
	$precio_b=$_REQUEST["b_".$k];
	//echo $precio_i."--".$precio_g."--".$precio_b."<br>";
	$conexion->query("update inmuebles set precio_base='$precio_i', garaje='$precio_g',baulera='$precio_b' where id='$id_inm'");
}
if((isset($_REQUEST["editor_nivel1"]))||(isset($_REQUEST["editor_nivel2"]))){
	$consulta=$conexion->query("select textocols from proyectos where id='$id_proy'");
	$registro=$consulta->fetch_row();
	$columnas=explode(":", $registro[0]);
	if(strpos($columnas[$nro_col-1], "@")!==false){
		$esta_columna=explode("@",$columnas[$nro_col-1]);
		$parte1=$esta_columna[0];
		$parte2=$esta_columna[1];
	}
	else{
		$parte1=$columnas[$nro_col-1];
		$parte2="";
	}
	if(isset($_REQUEST["editor_nivel1"])){
		$parte1=$_REQUEST["editor_nivel1"];
	}
	if(isset($_REQUEST["editor_nivel2"])){
		$parte2=$_REQUEST["editor_nivel2"];
	}
	$nuevo_nombre_col=$parte1."@".$parte2;
	$columnas[$nro_col-1]=$nuevo_nombre_col;
	$todas_cols=implode(":", $columnas);
	$conexion->query("update proyectos set textocols='$todas_cols' where id='$id_proy'");
}
mysqli_close($conexion);
?>
<html>

<body onload="document.getElementById('form1').submit();">
	<form name="form1" id='form1' action="inmuebles.php" method="post">
		<input type="hidden" name="proyectos" value="<?php echo $id_proy;?>">		
	</form>

</body>
</html>