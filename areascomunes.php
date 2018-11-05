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
<div id="div_lista_regs">
<input type="submit" name="button" id="button" value="Crear Nueva Area Comun" class="boton_nuevo_reg" onClick="$('.div_nuevo_registro').toggle(0);$('#div_lista_regs').toggle(0)">
<table class="tabla_cebra">
  <tr>
    <th width="4%" scope="col">&nbsp;</th>
    <th width="79%" scope="col">Areas Comunes</th>
    <th width="17%" scope="col">&nbsp;</th>
  </tr>
<?php
$filas=$conexion->query("select * from areascomunes");
$n=0;
while($unafila=$filas->fetch_row())
{
	$n++;
	echo "<tr><td>".$n."</td><td class='texto'>".$unafila[1]."</td><td><div class='op_elim3'><input type='hidden' name='id_reg' class='id_reg' value='".$unafila[0]."'><input  type='hidden' name='tabla_bd' class='tabla_bd' value='areascomunes'></div></td></tr>";
}
mysqli_close($conexion);
?>
</table>
</div>
<div class="div_nuevo_registro" style="display:none">
<form name="form_nuevo_reg" method="post" action="registra_area_comun.php" id="form_nuevo_reg">
Nombre del nuevo area comun: 
<label for="area"></label>
<input type="text" name="area" id="area" required class="validar">
<p>
<input type="submit" name="button2" id="button2" value="Guardar" class="boton_guardar"><input name="" type="button" value="Cancelar" class="boton_cancelar" onClick="$('#div_lista_regs').toggle(0);$('.div_nuevo_registro').toggle(0);$('#form_nuevo_reg').trigger('reset');">
</p>
</form>
</div>
</body>
</html>