<?php
session_start();
require_once "conector.php";
$login=$_REQUEST["login"];
$password=$_REQUEST["password"];
$resultado=$conexion->query("select id,nombre from usuarios where login='$login' and password='$password'");
if(mysqli_num_rows($resultado)>0)
{
	$datos=$resultado->fetch_row();
	$id_usr=$datos[0];
	$nombre_usr=$datos[1];
	$_SESSION["usr"]=$id_usr;
	$_SESSION["nombre"]=$nombre_usr;
	header("Location: inmuebles.php");
}
else
	header("Location: index.php");
mysqli_close($conexion);
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
</head>

<body>
</body>
</html>