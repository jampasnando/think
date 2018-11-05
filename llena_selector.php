<?php 
require_once "conector.php";
$tabla_selector=$_REQUEST["tabla_selector"];
$valor=$_REQUEST["valor"];
$resultado=$conexion->query("select * from $tabla_selector");
echo "<select name='selectorx' class='selectorx'>";
while($fila=$resultado->fetch_row()){
	if($valor==$fila[1]) $seleccionado=" selected='selected'"; else $seleccionado="";
	echo "<option value='".$fila[0]."' ".$seleccionado.">".$fila[1]."</option>";
}
echo "</select>";
mysqli_close($conexion);

?>