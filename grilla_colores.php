<?php 
require_once "conector.php";
 ?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
Esquemas de Colores:
<table>
	
	<?php
	$consulta=$conexion->query("select * from esquema_colores");
	$col=0;
	while($una_fila=$consulta->fetch_row()){
		$partes=explode(":", $una_fila[1]);
		$col++;
		if($col>4) {$col=1;echo "</tr>";}
		if($col==1) echo "<tr>";
		echo '<td class="unesquema"><div class="color1" style="background-color:'.$partes[0].';color:'.$partes[2].'"><span>TEXTO</span></div><div class="color2" style="background-color:'.$partes[1].';color:'.$partes[3].'"><span>TEXTO</span></div></td>';
	}
	?>

</table>
</body>
</html>