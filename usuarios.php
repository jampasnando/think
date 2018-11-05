<?php
require_once "conector.php";
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
<!--   <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script> -->
  <script type="text/javascript">
	$(document).ready(inicializar);
	function inicializar()
	{
		$("#fechanac").datepicker({dateFormat:'dd-mm-yy'});
	}
</script>

</head>

<body>
<div id="div_lista_regs">
<input type="submit" name="button" id="button" value="Crear Nuevo Usuario" class="boton_nuevo_reg" onClick="$('.div_nuevo_registro').toggle(0);$('#div_lista_regs').toggle(0)">
<table class="tabla_cebra">  
  <tr>
    <th width="4%" scope="col">&nbsp;</th>
    <th width="79%" scope="col">Nombre</th>
    <th width="17%" scope="col">CI</th>
    <th width="17%" scope="col">Nacido</th>
    <th width="17%" scope="col">Sexo</th>
    <th width="17%" scope="col">Celular</th>
    <th width="17%" scope="col">Fijo</th>
    <th width="17%" scope="col">Direccion</th>
    <th width="17%" scope="col">Facebook</th>
    <th width="17%" scope="col">Correo</th>
    <th width="17%" scope="col">Login</th>
    <th width="17%" scope="col">Password</th>
    <th width="17%" scope="col">Tipo</th>
    <th width="17%" scope="col">Opcion</th>
  </tr>
<?php
$filas=$conexion->query("select usuarios.*,tipos_usuario.tipo from usuarios inner join tipos_usuario on usuarios.tipo=tipos_usuario.id");
$n=0;
while($unafila=$filas->fetch_row())
{
	$n++;
	echo "<tr><td>".$n."</td><td class='texto'>".$unafila[1]."</td><td class='texto'>".$unafila[2]."</td><td class='texto'>".$unafila[3]."</td><td class='texto'>".$unafila[4]."</td><td class='texto'>".$unafila[5]."</td><td class='texto'>".$unafila[6]."</td><td class='texto'>".$unafila[7]."</td><td class='texto'>".$unafila[8]."</td><td class='texto'>".$unafila[9]."</td><td class='texto'>".$unafila[10]."</td><td class='texto'>".$unafila[11]."</td><td class='selector'>".$unafila[13	]."</td><td><div class='op_elim7'><input type='hidden' name='id_reg' class='id_reg' value='".$unafila[0]."'><input  type='hidden' name='usuarios' class='tabla_bd' value='usuarios:tipos_usuario'></div></td></tr>";
}
?>
</table>
</div>
<br>
<div class="div_nuevo_registro" style="display:none">
<form name="form_nuevo_reg" method="post" action="registra_usuarios.php" id="form_nuevo_reg">
  <table border="0">
    <tr>
      <td>Tipo de Usuario:
        <label for="tipo"></label>
        <select name="tipo" id="tipo"  required class="validar">
          <option value="">--Elija Tipo--</option>
          <?php
        	$tipos=$conexion->query("select * from tipos_usuario");
			while($filas=$tipos->fetch_row())
			{
				echo "<option value='".$filas[0]."'>".$filas[1]."</option>";
			}
			mysqli_close($conexion);
		?>
        </select>
        <br>
        <table border="0">
        <tr>
          <td>Nombre Completo</td>
          <td><label for="nombre"></label>
            <input type="text" name="nombre" id="nombre"  required class="validar"></td>
        </tr>
        <tr>
          <td>CI</td>
          <td><label for="ci"></label>
            <input type="text" name="ci" id="ci"></td>
        </tr>
        <tr>
          <td>Fecha Nacimiento</td>
          <td><label for="fechanac"></label>
            <input type="text" name="fechanac" id="fechanac" autocomplete="off"></td>
        </tr>
        <tr>
          <td>Sexo</td>
          <td><label for="sexo"></label>
            <input type="text" name="sexo" id="sexo"></td>
        </tr>
        <tr>
          <td>Celular</td>
          <td><label for="celular"></label>
            <input type="text" name="celular" id="celular" required class="validar"></td>
        </tr>
        <tr>
          <td>Fijo</td>
          <td><label for="fijo"></label>
            <input type="text" name="fijo" id="fijo"></td>
        </tr>
        <tr>
          <td>Direccion</td>
          <td><label for="direccion"></label>
            <input type="text" name="direccion" id="direccion"></td>
        </tr>
        <tr>
          <td>Facebook</td>
          <td><label for="facebook"></label>
            <input type="text" name="facebook" id="facebook"></td>
        </tr>
        <tr>
          <td>correo</td>
          <td><label for="correo"></label>
            <input type="text" name="correo" id="correo"></td>
        </tr>
        <tr>
          <td>Login</td>
          <td><label for="login"></label>
            <input type="text" name="login" id="login"  required class="validar"></td>
        </tr>
        <tr>
          <td>Password</td>
          <td><label for="password"></label>
            <input type="text" name="password" id="password"  required class="validar"></td>
        </tr>
      </table></td>
      <td valign="top">&nbsp;</td>
    </tr>
  </table>
  <br>
  <p>
    <input type="submit" name="button2" id="button2" value="Guardar" class="boton_guardar"><input name="" type="button" value="Cancelar" class="boton_cancelar" onClick="$('#div_lista_regs').toggle(0);$('.div_nuevo_registro').toggle(0);$('#form_nuevo_reg').trigger('reset');">

  </p>
</form>
</div>
</body>
</html>