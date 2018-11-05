<?php
require_once "conector.php";
$tipo=$_REQUEST["tipo"];
$conexion->query("insert into tipos_inmueble values('','$tipo')");
mysqli_close($conexion);
?>
<html>
<body onload="document.getElementById('form_ir_inmueble').submit();">
	<form name="form_ir_inmueble" id="form_ir_inmueble" action="inmuebles.php" method="post">
		
	</form>
</body>
</html>