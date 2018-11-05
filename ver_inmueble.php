<?php
require_once "conector.php";
$id=$_REQUEST["id"];
$consulta=$conexion->query("select * from inmuebles where id='$id'");
$inmueble=$consulta->fetch_row();
$fechacreado=explode(" ",$inmueble[5]);
$fechayhoracreado=implode("/",array_reverse(explode("-",$fechacreado[0])))." ".$fechacreado[1];
if($inmueble[8]!="0000-00-00 00:00:00")
{
	$vfechaini=explode(" ",$inmueble[8]);
	$fechaini=implode("/",array_reverse(explode("-",$vfechaini[0])))." ".$vfechaini[1];
}
else $fechaini="";
if($inmueble[9]!="0000-00-00 00:00:00")
{
	$vfechafin=explode(" ",$inmueble[9]);
	$fechafin=implode("/",array_reverse(explode("-",$vfechafin[0])))." ".$vfechafin[1];
}
else $fechafin="";
?>
<form name="form2" method="post" action="actualiza_inmueble.php">
  
  <table width="100%" border="0">
    <tr>
      <td><h1> Inmueble</h1></td>
      <td align="right">creado:
        <label for="creado"></label>
      <input name="creado" type="text" id="creado" value="<?php echo $fechayhoracreado;?>" size="14" readonly="readonly" /></td>
    </tr>
  </table>
<input name="id_inm" type="hidden" id="id_inm" value="<?php echo $id;?>" />
<table width="100%" border="0">
  <tr>
    <td><table border="0">
      <tr>
        <td>Planta:</td>
        <td>
          <!-- <input type="text" name="plantax" id="plantax" /> -->
          <textarea name="plantax" id="plantax" rows="1" readonly="readonly"></textarea>
          <input name="proyx" type="hidden" id="proyx" />
          <input type="hidden" name="posfila" id="posfila"/></td>
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
        <td><select name="tipoinm" id="tipoinm">
          <option value="">Elija Tipo</option>
          <?php
		  $tipo=$conexion->query("select * from tipos_inmueble");
		  while($filas=$tipo->fetch_row())
		  {
			if($inmueble[2]==$filas[0]) $elegido=" selected='selected'"; else $elegido="";
			echo "<option value='".$filas[0]."' ".$elegido.">".$filas[1]."</option>";
		  }
		?>
        </select></td>
      </tr>
      <tr>
        <td>Estado:</td>
        <td><select name="estadoinm" id="estadoinm">
          <option value="">--Elija Estado--</option>
          <?php
		  $estado=$conexion->query("select * from estados_inmueble");
		  while($filas=$estado->fetch_row())
		  {
			if($inmueble[3]==$filas[0]) $elegido=" selected='selected'"; else $elegido="";
			echo "<option value='".$filas[0]."' ".$elegido.">".$filas[1]."</option>";
		  }
    	?>
        </select></td>
      </tr>
      <tr>
        <td>Precio Base </td>
        <td><input name="precio" type="text" id="precio" size="10" maxlength="10" value="<?php echo $inmueble[4];?>" /></td>
      </tr>
        <tr>
          <td>Garaje</td>
          <td><input type="text" name="garaje" id="garaje" size="10" maxlength="10" value="<?php echo $inmueble[14];?>"></td>
        </tr>
        <tr>
          <td>Baulera</td>
          <td><input type="text" name="baulera" id="baulera" size="10" maxlength="10" value="<?php echo $inmueble[15];?>"></td>
        </tr>
     </table>
   </td>
    <td><table border="0">
      <tr>
        <td>Cliente</td>
        <td><select name="cliente" id="cliente">
          <option value="" selected="selected"></option>
          <?php
        $resultadocli=$conexion->query("select id,nombre,celular from clientes");
		while($uncliente=$resultadocli->fetch_row())
		{
			if($uncliente[0]==$inmueble[6]) $elegidocli=" selected='selected'"; else $elegidocli="";
			echo "<option value='".$uncliente[0]."' ".$elegidocli.">".$uncliente[1]."(".$uncliente[2].")</option>";
		}
		?>
        </select></td>
      </tr>
      <tr>
        <td>A cuenta</td>
        <td><label for="acuenta"></label>
          <input type="text" name="acuenta" id="acuenta" value="<?php echo $inmueble[10];?>"/></td>
      </tr>
      <tr>
        <td>Moneda</td>
        <td><label for="moneda"></label>
          <select name="moneda" id="moneda">
            <option value="" selected="selected"></option>
            <option value="dolares" <?php if($inmueble[11]=="dolares") echo 'selected="selected";'?>>dolares</option>
            <option value="bolivianos" <?php if($inmueble[11]=="bolivianos") echo 'selected="selected";'?>>bolivianos</option>
            <option value="euros" <?php if($inmueble[11]=="euros") echo 'selected="selected";'?>>euros</option>
          </select></td>
      </tr>
      <tr>
        <td>Fecha Inicio</td>
        <td><label for="fechaini"></label>
          <input type="text" name="fechaini" id="fechaini" autocomplete="off" value="<?php echo $fechaini;?>"/></td>
      </tr>
      <tr>
        <td>Fecha Fin</td>
        <td><label for="fechafin"></label>
          <input type="text" name="fechafin" id="fechafin" autocomplete="off" value="<?php echo $fechafin;?>"/></td>
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
			if($unusr[0]==$inmueble[7]) $elegidousr=" selected='selected'"; else $elegidousr="";
			echo "<option value='".$unusr[0]."' ".$elegidousr.">".$unusr[1]."(".$unusr[2].")</option>";
		}
		?>
          </select></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td><input type="submit" name="button2" id="button2" value="Guardar" onclick="//alert(document.getElementById('fechaini').value +'--'+ document.getElementById('fechafin').value);"/></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>Ambientes incluidos:<br />
      <?php
//		$amb_propios_actuales=$conexion->query("SELECT ambientes_propios.*,cantidad FROM ambientes_propios left join (SELECT * from ambientes_propios_inmueble where inmuebles_id='$id') as tb1 ON ambientes_propios.id=tb1.ambientes_propios_id");
//		while($reg_amb_propios=$amb_propios_actuales->fetch_row())
//		{
//			echo $reg_amb_propios[3]."<br>";
//		}
      $ambientes=$conexion->query("SELECT ambientes_propios.*,cantidad FROM ambientes_propios left join (SELECT * from ambientes_propios_inmueble where inmuebles_id='$id') as tb1 ON ambientes_propios.id=tb1.ambientes_propios_id");
      $nro_amb=0;
	  echo "<table>";
	  while($filas=$ambientes->fetch_row())
      {
        if($filas[2]>=1) $chequeado=" checked='checked'"; else $chequeado="";
		$nro_amb++;
		echo "<tr><td><input type='checkbox' name='ambientes[]' id='amb_".$nro_amb."' value='".$filas[0].":".$nro_amb."' ".$chequeado.">".$filas[1]."</td><td><input type='text' name='valor_".$filas[0]."' id='valor_".$filas[0]."' value='".$filas[2]."' size='2' maxlength='2'></td>";
      }
	  echo "</table>";
		mysqli_close($conexion);
    ?>
      <input type="submit" name="button" id="button" value="Guardar" /></td>
    <td>&nbsp;</td>
  </tr>
</table>
<label for="plantax"></label>
  <label for="columnax"></label>
  <label for="tipoinm"></label>
  <label for="estadoinm"></label>
  <br>
  <hr/>
  <p>&nbsp;</p>
  
</form>
