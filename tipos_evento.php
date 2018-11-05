<?php
require_once "conector.php";
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
</head>

<body>
<table width="50%" border="1">
  <tr>
    <th width="4%" scope="col">&nbsp;</th>
    <th width="79%" scope="col">Tipos de Eventos</th>
    <th width="17%" scope="col">Acrónimo</th>
    <th width="17%" scope="col">&nbsp;</th>
  </tr>
<?php
$filas=$conexion->query("select * from tipos_evento");
$n=0;
while($unafila=$filas->fetch_row())
{
	$n++;
	echo "<tr><td>".$n."</td><td>".$unafila[1]."</td><td>".$unafila[2]."</td><td></td></tr>";
}
mysqli_close($conexion);
?>
</table>
<input type="submit" name="button" id="button" value="Crear Nueva tipo de Evento">
<form name="form1" method="post" action="registra_tipo_evento.php">
Nombre del nuevo tipo de Evento:
  <label for="tipo"></label>
  <input type="text" name="tipo" id="tipo">
  <br>
  Acronimo
  :
  <label for="acronimo"></label>
  <input type="text" name="acronimo" id="acronimo">
  <p>
    <input type="submit" name="button2" id="button2" value="Guardar">
  </p>
</form>
</body>
</html>