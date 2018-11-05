<?php
require_once "conector.php";
$nombre=$_REQUEST["nombre"];
$ci=$_REQUEST["ci"];
$fechanac=$_REQUEST["fechanac"];
$sexo=$_REQUEST["sexo"];
$celular=$_REQUEST["celular"];
$fijo=$_REQUEST["fijo"];
$direccion=$_REQUEST["direccion"];
$facebook=$_REQUEST["facebook"];
$correo=$_REQUEST["correo"];
$login=$_REQUEST["login"];
$password=$_REQUEST["password"];
$tipo=$_REQUEST["tipo"];

$conexion->query("insert into usuarios values('','$nombre','$ci','$fechanac','$sexo','$celular','$fijo','$direccion','$facebook','$correo','$login','$password','$tipo')");
mysqli_close($conexion);
?>
<html>
<body onload="document.getElementById('form_ir_inmueble').submit();">
	<form name="form_ir_inmueble" id="form_ir_inmueble" action="inmuebles.php" method="post">
		
	</form>
</body>
</html>