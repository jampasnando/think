<?php
require_once "conector.php";
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>

<script type="text/javascript">
	
</script>

</head>

<body>
<div id="div_lista_proys">
<input type="submit" name="button" id="button" value="Crear Nuevo Proyecto" class="boton_nuevo_reg" onClick="$('.div_nuevo_registro').toggle(0);$('#div_lista_proys').toggle(0)">
<table id="lista_proys" class="tabla_cebra">
  <tr>
    <th width="4%" scope="col">&nbsp;</th>
    <th width="79%" scope="col">Nombre</th>
    <th width="17%" scope="col">Direccion</th>
    <th width="17%" scope="col">Telefonos</th>
    <th width="17%" scope="col">Latitud</th>
    <th width="17%" scope="col">Longitud</th>
    <th width="17%" scope="col">Fecha Reg</th>
    <th width="17%" scope="col">Descripción</th>
    <th width="17%" scope="col">Estado</th>
    <th width="17%" scope="col">Avance</th>
    <th width="17%" scope="col">&nbsp;</th>
  </tr>
<?php
$filas=$conexion->query("select proyectos.*,estados_proyecto.estado from proyectos inner join estados_proyecto on proyectos.estado=estados_proyecto.id order by proyectos.id");
$n=0;
while($unafila=$filas->fetch_row())
{
	$n++;
	
  echo "<tr><td>".$n."</td><td class='texto'>".$unafila[1]."</td><td class='texto'>".$unafila[2]."</td><td class='texto'>".$unafila[3]."</td><td class='texto'>".$unafila[4]."</td><td class='texto'>".$unafila[5]."</td><td class='texto'>".$unafila[6]."</td><td class='texto'>".$unafila[7]."</td><td class='selector'>".$unafila[12]."</td><td class='texto'>".$unafila[9]."</td><td><div class='op_elim'><input type='hidden' name='id_reg' class='id_reg' value='".$unafila[0]."'><input  type='hidden' name='tabla_bd' class='tabla_bd' value='proyectos:estados_proyecto'></div></td></tr>";
}
?>
</table>
</div>
<div class="div_nuevo_registro" style="display:none">
<form name="form_nuevo_proy" method="post" action="registra_proyecto.php" id="form_nuevo_proy"  >
  <h3>Nuevo Proyecto:</h3>
  <table width="100%" border="0">
    <tr>
      <td><table class="tb_nuevo_proy">
        <tr>
          <td>Nombre</td>
          <td><label for="nombre"></label>
            <input type="text" name="nombre" id="nombre" required class="validar"></td>
        </tr>
        <tr>
          <td>Direccion</td>
          <td><label for="direccion"></label>
            <input type="text" name="direccion" id="direccion"></td>
        </tr>
        <tr>
          <td>Telefonos</td>
          <td><label for="telefonos"></label>
            <input type="number" name="telefonos" id="telefonos" pattern="[0-9]" autocomplete="off"></td>
        </tr>
        <tr>
          <td>Latitud</td>
          <td><label for="latitud"></label>
            <input type="text" name="latitud" id="latitud"></td>
        </tr>
        <tr>
          <td>Longitud</td>
          <td><label for="longitud"></label>
            <input type="text" name="longitud" id="longitud"></td>
        </tr>
        <tr>
          <td>Descripción</td>
          <td><label for="descripcion"></label>
            <textarea name="descripcion" id="descripcion"></textarea></td>
        </tr>
        <tr>
          <td>Estado</td>
          <td><label for="avance"></label>
            <select name="estado" id="estado" required class="validar">
              <option value="">--Elija un Estado--</option>
              <?php
        	$estados=$conexion->query("select * from estados_proyecto");
			while($filas=$estados->fetch_row())
			{
				echo "<option value='".$filas[0]."'>".$filas[1]."(".$filas[2].")</option>";
			}

		?>
            </select></td>
        </tr>
        <tr>
          <td>Avance</td>
          <td><label for="estado"></label>
            <input type="range" name="avance" id="avance" min="0" max="100" onInput="document.getElementById('valor_avance').innerHTML=this.value;" value="0"><span id="valor_avance">0</span>%</td>
        </tr>
      </table></td>
      <td valign="top" class="fondo_amarillo">Crear inmuebles en masa:<br>
        <table border="0">
        <tr>
          <td>Nro. Plantas:</td>
          <td><input type="number" name="filasx" id="filasx" min="0" step="1" autocomplete="off" value="9" title="Ejemplo: 5 añadirá inmubles para la PB y pisos 1,2,3,4" style="width: 3em" /></td>
        </tr>
        <tr>
          <td>Nro de inm/planta</td>
          <td><input type="number" name="columnasx" id="columnasx" min="1" step="1" autocomplete="off" value="7" title="Ejemplo 7 añadirá inmuebles para las primeras 7 columnas" style="width:3em" /></td>
        </tr>
        <tr>
          <td>Tipo de Inmueble:</td>
          <td><select name="tipoinm" id="tipoinm">
            <option value="">Elija Tipo</option>
            <?php
		  $tipo=$conexion->query("select * from tipos_inmueble");
		  while($filas=$tipo->fetch_row())
		  {
			echo "<option value='".$filas[0]."'>".$filas[1]."</option>";
		  }
		?>
          </select></td>
        </tr>
        <tr>
          <td>Estado Inmueble:</td>
          <td><select name="estadoinm" id="estadoinm">
            <option value="">--Elija Estado--</option>
            <?php
		  $estado=$conexion->query("select * from estados_inmueble");
		  while($filas=$estado->fetch_row())
		  {
			echo "<option value='".$filas[0]."'>".$filas[1]."</option>";
		  }
    	?>
          </select></td>
        </tr>
        <tr>
          <td>Precio Base </td>
          <td><input name="precio" type="text" id="precio" size="10" maxlength="10" />
          $us</td>
        </tr>
        <tr>
          <td>Garaje</td>
          <td><input type="text" name="garaje" id="garaje" size="10" maxlength="10"></td>
        </tr>
        <tr>
          <td>Baulera</td>
          <td><input type="text" name="baulera" id="baulera" size="10" maxlength="10"></td>
        </tr>
      </table></td>
      <td class="fondo_amarillo">Ambientes incluidos:<br />
      <?php
      $ambientes=$conexion->query("select * from ambientes_propios");
      $nro_amb=0;
	  echo "<table>";
	  while($filas=$ambientes->fetch_row())
      {
        $nro_amb++;
		echo "<tr><td><input type='checkbox' name='ambientes[]' id='amb_".$nro_amb."' value='".$filas[0].":".$nro_amb."'>".$filas[1]."</td><td><input type='text' name='valor_".$filas[0]."' id='valor_".$filas[0]."' value='1' size='1' maxlength='2' class='cantidad_amb_propio'></td>";
      }
	  echo "</table>";
		mysqli_close($conexion);
    ?></td>
    </tr>
  </table>
<label for="ambiente"></label>
  <input type="submit" name="button2" id="button2" value="Guardar" class="boton_guardar"><input name="" type="button" value="Cancelar" class="boton_cancelar" onClick="$('#div_lista_proys').toggle(0);$('.div_nuevo_registro').toggle(0);$('#form_nuevo_proy').trigger('reset');">
</form>
</div>
</body>
</html>