<?php
require_once "conector.php";
$proyecto=$_REQUEST["proyecto"];
$cadenafilas=$_REQUEST["cadenafilas"];
$vcadenafilas=explode(":",$cadenafilas);
$cantidadfilas=$count($vcadenafilas);
$resultado=$conexion->query("select textofilas from proyectos where id='$proyecto'");
$textfilas=$resultado->fetch_row();
$vtextfilas=explode(":",$textfilas);
$antcantidad=count($vtextfilas);
$diferencia=
$cadenacolumnas=$_REQUEST["cadenacolumnas"];
$conexion->query("update proyectos set textofilas='$cadenafilas',textocols='$cadenacolumnas' where id='$proyecto'");
mysqli_close($conexion);
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
</head>

<body onLoad="document.getElementById('form1').submit()">
<form action="inmuebles.php" method="post" name="form1" id="form1">
  <input name="proyectos" type="hidden" id="proyectos" value="<?php echo $proyecto;?>">
</form>
</body>
</html>