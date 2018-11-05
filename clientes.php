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
<input type="submit" name="button" id="button" value="Crear Nuevo Cliente" class="boton_nuevo_reg" onClick="$('.div_nuevo_registro').toggle(0);$('#div_lista_regs').toggle(0)">
<table class="tabla_cebra">
  <tr>
    <td>N</td>
    <td>Nombre</td>
    <td>Sexo</td>
    <td>Direccion</td>
    <td>Telf</td>
    <td>Celular</td>
    <td>Correo</td>
    <td>Facebook</td>
    <td>Whatsapp</td>
    <td>Twitter</td>
    <td>&nbsp;</td>
  </tr>
  <?php
  $resultado=$conexion->query("select * from clientes");
  $n=0;
  while($un_reg=$resultado->fetch_row())
  {
  	
    $n++;
    echo "<tr><td>".$n."</td><td class='texto'>".$un_reg[1]."</td><td class='texto'>".$un_reg[2]."</td><td class='texto'>".$un_reg[3]."</td><td class='texto'>".$un_reg[4]."</td><td class='texto'>".$un_reg[5]."</td><td class='texto'>".$un_reg[6]."</td><td class='texto'>".$un_reg[7]."</td><td class='texto'>".$un_reg[8]."</td><td class='texto'>".$un_reg[9]."</td><td><div class='op_elim9'><input type='hidden' name='id_reg' class='id_reg' value='".$un_reg[0]."'><input  type='hidden' name='tabla_bd' class='tabla_bd' value='clientes'></div></td></tr>";
  }
  ?>
</table>
</div>

<div class="div_nuevo_registro" style="display:none">
<form name="form_nuevo_reg" method="post" action="registra_cliente.php" id="form_nuevo_reg">  
  <h2>Nuevo Cliente</h2>
  <table border="0">
    <tr>
      <td>Nombre</td>
      <td><label for="nombre"></label>
      <input type="text" name="nombre" id="nombre" required class="validar"></td>
    </tr>
    <tr>
      <td>Sexo</td>
      <td><label for="sexo"></label>
      <input type="text" name="sexo" id="sexo"></td>
    </tr>
    <tr>
      <td>Direccion</td>
      <td><label for="direccion"></label>
      <input type="text" name="direccion" id="direccion"></td>
    </tr>
    <tr>
      <td>Telf</td>
      <td><label for="telf"></label>
      <input type="text" name="telf" id="telf"></td>
    </tr>
    <tr>
      <td>Celular</td>
      <td><label for="celular"></label>
      <input type="text" name="celular" id="celular" required class="validar"></td>
    </tr>
    <tr>
      <td>Correo</td>
      <td><label for="correo"></label>
      <input type="text" name="correo" id="correo"></td>
    </tr>
    <tr>
      <td>Facebook</td>
      <td><label for="facebook"></label>
      <input type="text" name="facebook" id="facebook"></td>
    </tr>
    <tr>
      <td>Whatsapp</td>
      <td><label for="whatsapp"></label>
      <input type="text" name="whatsapp" id="whatsapp"></td>
    </tr>
    <tr>
      <td>Twitter</td>
      <td><label for="twitter"></label>
      <input type="text" name="twitter" id="twitter"></td>
    </tr>
  </table>
  <p>
    <input type="submit" name="button2" id="button2" value="Guardar" class="boton_guardar"><input name="" type="button" value="Cancelar" class="boton_cancelar" onClick="$('#div_lista_regs').toggle(0);$('.div_nuevo_registro').toggle(0);$('#form_nuevo_reg').trigger('reset');">
  </p>
</form>
</div>
</body>
</html>