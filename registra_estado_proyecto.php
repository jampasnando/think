<?php
require_once "conector.php";
$estado=$_REQUEST["estado"];
$acronimo=$_REQUEST["acronimo"];
$conexion->query("insert into estados_proyecto values('','$estado','$acronimo')");
mysqli_close($conexion);
?>
<html>
<body onload="document.getElementById('form_ir_inmueble').submit();">
	<form name="form_ir_inmueble" id="form_ir_inmueble" action="inmuebles.php" method="post">
		
	</form>
</body>
</html>