<?php
require_once "conector.php";
$estado=$_REQUEST["estado"];
$acronimo=$_REQUEST["acronimo"];
$color=$_REQUEST["color"];
$conexion->query("insert into estados_inmueble values('','$estado','$acronimo','$color')");
mysqli_close($conexion);
?>
<html>
<body onload="document.getElementById('form_ir_inmueble').submit();">
	<form name="form_ir_inmueble" id="form_ir_inmueble" action="inmuebles.php" method="post">
		
	</form>
</body>
</html>