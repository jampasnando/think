<?php
$nuevocolor=$_REQUEST["nuevocolor"];
$nombreestado=$_REQUEST["nombreestado"];
require_once "conector.php";
$conexion->query("update estados_inmueble set color='$nuevocolor' where estado='$nombreestado'");
mysqli_close($conexion);
?>
<html>
<body onLoad="window.location='estados_inmueble.php'">

</body>
</html>