<?php
require_once "conector.php";
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
<style>
.celdacolor{

}
#nuevo{
	display:none;
}
</style>
</head>

<body>
<div id="div_lista_regs">
<input type="submit" name="button" id="button" value="Crear Nuevo Estado de Inmueble" class="boton_nuevo_reg" onClick="$('.div_nuevo_registro').toggle(0);$('#div_lista_regs').toggle(0)">
<table>
  <tr>
    <td>
      <table  class="tabla_cebra">
      <tr>
        <th scope="col">&nbsp;</th>
        <th scope="col">Estados de Inmueble</th>
        <th scope="col">Acrónimo</th>
        <th scope="col">Color</th>
        <th scope="col">&nbsp;</th>
      </tr>
      <?php
$filas=$conexion->query("select * from estados_inmueble");
$n=0;
while($unafila=$filas->fetch_row())
{
	$n++;
  $colores=explode(":",$unafila[3]);
	echo "<tr><td>".$n."</td><td class='texto'>".$unafila[1]."</td><td class='texto'>".$unafila[2]."</td><td class='esquema_colores' style='cursor:pointer'><div class='color1' style='background-color:".$colores[0].";color:".$colores[2]."'><span>TEXTO</span></div><div class='color2' style='background-color:".$colores[1].";color:".$colores[3]."'><span>TEXTO</span></div></td><td><div class='op_elim5'><input type='hidden' name='id_reg' class='id_reg' value='".$unafila[0]."'><input  type='hidden' name='tabla_bd' class='tabla_bd' value='estados_inmueble'></div></td></tr>";
}
mysqli_close($conexion);
?>
    </table>
  </td>
    <td>
    <div class="contenedor_grilla_colores" style="border:1px solid lightgray;cursor:pointer">
<!--       <form name="form2" method="post" action="actualiza_color_estado_inm.php">
        <h1>Nuevo color para:
          
        </h1><input type="hidden" name="nombreestado" id="nombreestado">
        <p>Nuevo color:
          <input type="text" name="nuevocolor" id="nuevocolor" class="jscolor">
        </p>
        <input type="submit" name="button3" id="button3" value="Guardar">
      </form>
      <p>&nbsp;</p> -->
    </div>
    </td>
  </tr>
</table>
</div>
<div class="div_nuevo_registro" style="display:none">
<form name="form_nuevo_reg" method="post" action="registra_estado_inmueble.php" id="form_nuevo_reg">
  <p>Nombre del nuevo Estado de Inmueble:
    <label for="estado"></label>
  <input type="text" name="estado" id="estado" required class="validar">
  <br>
  Acronimo
  :
  <label for="acronimo"></label>
  <input type="text" name="acronimo" id="acronimo" required class="validar">
  <br>
  Color: 
  <label for="color"></label>
  <input type="text" name="color" id="color" required class="validar">
  </p>
  <p>
    <input type="submit" name="button2" id="button2" value="Guardar" class="boton_guardar"><input name="" type="button" value="Cancelar" class="boton_cancelar" onClick="$('#div_lista_regs').toggle(0);$('.div_nuevo_registro').toggle(0);$('#form_nuevo_reg').trigger('reset');">
  </p>
</form>
</div>
</body>
</html>