<?php
require_once "conector.php";
$nombre=$_REQUEST["nombre"];
$sexo=$_REQUEST["sexo"];
$direccion=$_REQUEST["direccion"];
$telf=$_REQUEST["telf"];
$celular=$_REQUEST["celular"];
$correo=$_REQUEST["correo"];
$facebook=$_REQUEST["facebook"];
$whatsapp=$_REQUEST["whatsapp"];
$twitter=$_REQUEST["twitter"];
$conexion->query("insert into clientes values('','$nombre','$sexo','$direccion','$telf','$celular','$correo','$facebook','$whatsapp','$twitter')");

?>
<html>
<body onload="document.getElementById('form_ir_inmueble').submit();">
	<form name="form_ir_inmueble" id="form_ir_inmueble" action="inmuebles.php" method="post">
		
	</form>
</body>
</html>