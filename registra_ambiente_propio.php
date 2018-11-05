<?php
require_once "conector.php";
$ambiente=$_REQUEST["ambiente"];
$conexion->query("insert into ambientes_propios values('','$ambiente')");
mysqli_close($conexion);
?>
<html>
<body onload="document.getElementById('form_ir_inmueble').submit();">
	<form name="form_ir_inmueble" id="form_ir_inmueble" action="inmuebles.php" method="post">
		
	</form>
</body>
</html>