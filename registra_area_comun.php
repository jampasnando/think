<?php
session_start();
require_once "conector.php";
$area=$_REQUEST["area"];
$conexion->query("insert into areascomunes values('','$area')");
mysqli_close($conexion);
?>
<html>
<body onload="document.getElementById('form_ir_inmueble').submit();">
	<form name="form_ir_inmueble" id="form_ir_inmueble" action="inmuebles.php" method="post">
		
	</form>
</body>
</html>