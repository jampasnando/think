<?php
require_once "conector.php";
?>
<form name="form2" method="post" action="registra_inmueble.php">
  <h1>Nuevo Inmueble</h1>
  <table width="100%" border="0">
    <tr>
      <td valign="top"><table border="0">
        <tr>
          <td>Planta:</td>
          <td>
            <!-- <input type="text" name="plantax" id="plantax" /> -->
            <textarea name="plantax" id="plantax" rows="1" readonly="readonly"></textarea>
            <input name="proyx" type="hidden" id="proyx" />
            <input type="hidden" name="posfila" id="posfila" /></td>
        </tr>
        <tr>
          <td>Columna:</td>
          <td>
            <!-- <input type="text" name="columnax" id="columnax" /> -->
            <textarea name="columnax" id="columnax" rows="3" readonly="readonly"></textarea>
            <input type="hidden" name="poscol" id="poscol" /></td>
        </tr>
        <tr>
          <td>Tipo de Inmueble:</td>
          <td>
            <select name="tipoinm" id="tipoinm" required class="validar">
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
          <td>Estado:</td>
          <td>
            <select name="estadoinm" id="estadoinm" required class="validar">
            <option value="">--Elija Estado--</option>
            <?php
		  $estado=$conexion->query("select * from estados_inmueble");
		  while($filas=$estado->fetch_row())
		  {
			echo "<option value='".$filas[0]."'>".$filas[1]."</option>";
		  }
    	?>
          </select>
        </td>
        </tr>
        <tr>
          <td>Precio Base </td>
          <td><input name="precio" type="text" id="precio" size="10" maxlength="10" />$us</td>
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
      <td valign="top"><table border="0">
        <tr>
          <td>Cliente</td>
          <td><select name="cliente" id="cliente">
            <option value="" selected="selected"></option>
            <?php
        $resultadocli=$conexion->query("select id,nombre,celular from clientes");
		while($uncliente=$resultadocli->fetch_row())
		{
			echo "<option value='".$uncliente[0]."'>".$uncliente[1]."(".$uncliente[2].")</option>";
		}
		?>
          </select></td>
        </tr>
        <tr>
          <td>A cuenta</td>
          <td><label for="acuenta"></label>
            <input type="text" name="acuenta" id="acuenta" /></td>
        </tr>
        <tr>
          <td>Moneda</td>
          <td><label for="moneda"></label>
            <select name="moneda" id="moneda">
              <option value="" selected="selected"></option>
              <option value="dolares">dolares</option>
              <option value="bolivianos">bolivianos</option>
              <option value="euros">euros</option>
            </select></td>
        </tr>
        <tr>
          <td>Fecha Inicio</td>
          <td><label for="fechaini"></label>
            <input type="text" name="fechaini" id="fechaini" autocomplete="off" /></td>
        </tr>
        <tr>
          <td>Fecha Fin</td>
          <td><label for="fechafin"></label>
            <input type="text" name="fechafin" id="fechafin" autocomplete="off" /></td>
        </tr>
        <tr>
          <td>Usuario</td>
          <td><label for="fechafin"></label>
            <select name="usuario" id="usuario">
              <option value=""></option>
              <?php
        $resultadousr=$conexion->query("select id,nombre,celular from usuarios");
		while($unusr=$resultadousr->fetch_row())
		{
			echo "<option value='".$unusr[0]."'>".$unusr[1]."(".$unusr[2].")</option>";
		}
		?>
            </select></td>
        </tr>
      </table></td>
    </tr>
    <tr>
      <td valign="top"><input type="submit" name="button2" id="button2" value="Guardar" /></td>
      <td valign="top">&nbsp;</td>
    </tr>
    <tr>
      <td valign="top">Ambientes incluidos:<br />
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
    ?>
      <input type="submit" name="button" id="button" value="Guardar" /></td>
      <td valign="top">&nbsp;</td>
    </tr>
  </table>
  <p>&nbsp;</p>
  <label for="plantax"></label>
  <label for="columnax"></label>
  <label for="tipoinm"></label>
  <label for="estadoinm"></label>
</form>
