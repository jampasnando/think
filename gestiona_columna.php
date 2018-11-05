<table class="tb_precios">
	<tr>
		<td></td>
		<td>Inmueble</td>
		<td>Garaje</td>
		<td>Baulera</td>
	</tr>
	<tr>
		<td>Cambiar a</td>
		<td><input type="text" name="precio_inm" class="casilla_propaga" ><input type="button" name="boton" value="&darr;" class="propagador_precios"></td>
		<td><input type="text" name="precio_garaje" class="casilla_propaga"><input type="button" name="boton" value="&darr;" class="propagador_precios"></td>
		<td><input type="text" name="precio_baulera" class="casilla_propaga"><input type="button" name="boton" value="&darr;" class="propagador_precios"></td>
	</tr>
	<tr>
		<td>+/-</td>
		<td><input type="text" name="precio_inm" class="casilla_propaga" ><input type="button" name="boton" value="&darr;" class="propagador_adicion"></td>
		<td><input type="text" name="precio_garaje" class="casilla_propaga"><input type="button" name="boton" value="&darr;" class="propagador_adicion"></td>
		<td><input type="text" name="precio_baulera" class="casilla_propaga"><input type="button" name="boton" value="&darr;" class="propagador_adicion"></td>
	</tr>
	<tr>
		<td>%</td>
		<td><input type="text" name="precio_inm" class="casilla_propaga" ><input type="button" name="boton" value="&darr;" class="propagador_porcentaje"></td>
		<td><input type="text" name="precio_garaje" class="casilla_propaga"><input type="button" name="boton" value="&darr;" class="propagador_porcentaje"></td>
		<td><input type="text" name="precio_baulera" class="casilla_propaga"><input type="button" name="boton" value="&darr;" class="propagador_porcentaje"></td>
	</tr>

</table>
<?php 
require_once "conector.php";

$nro_col=$_REQUEST["nro_col"];
$id_proy=$_REQUEST["id_proy"];
// $nro_col=3;
// $id_proy=1;
$filasycolumnas=$conexion->query("select textofilas,textocols from proyectos where id='$id_proy'");
$unreg_filascolumnas=$filasycolumnas->fetch_row();
$filas=explode(":", $unreg_filascolumnas[0]);
$columnas=explode(":", $unreg_filascolumnas[1]);
$esta_columna=$columnas[$nro_col-1];
$resultado=$conexion->query("select id,precio_base,garaje,baulera,posfila  from inmuebles where proyectos_id='$id_proy' and poscol='$nro_col' order by posfila");
echo "<form name='form_act_col' action='actualiza_precios_enmasa.php' method='post'>";
echo "<table width='100%'><tr><td width='60%'>";
echo "<table class='clase_tabla_columnas'>";
echo "<tr><td></td><td>Inmueble</td><td>Garaje</td><td>Baulera</td></tr>";
$n=0;
while($un_registro=$resultado->fetch_row()){
	$n++;
	echo "<tr><td><input type='hidden' name='id_inm_".$n."' value='".$un_registro[0]."'>".$filas[$un_registro[4]-1]."</td><td><div class='antiguo_valor'>".$un_registro[1]."&nbsp;</div><input name='i_".$n."' type='text' value='".$un_registro[1]."' class='clase_gestion_cols'></td><td><div class='antiguo_valor'>".$un_registro[2]."&nbsp;</div><input name='g_".$n."' type='text' value='".$un_registro[2]."' class='clase_gestion_cols'></td><td><div class='antiguo_valor'>".$un_registro[3]."&nbsp;</div><input name='b_".$n."' type='text' value='".$un_registro[3]."' class='clase_gestion_cols'></td></tr>";
}
echo "</table><br>";

echo "<input type='submit' name='boton2' class='boton_envia' value='Guardar Cambios'><input type='hidden' name='nro_filas' value='".$n."'><input name='id_proy' type='hidden' value='".$id_proy."'><input type='hidden' name='nro_col' value='".$nro_col."'>";
echo "</td><td valign='top'>";
if(strpos($esta_columna,"@")!==false){
	$niveles=explode("@", $esta_columna);
	$nivel1=nl2br($niveles[0]);
	$nivel2=nl2br($niveles[1]);
	echo '<div class="div_col_titulo2 centrar_cont"><div class="columna_nivel1">'.$nivel1.'</div><div class="columna_nivel2">'.$nivel2.'</div></div>';
}
else{
	echo '<div class="div_col_titulo2 centrar_cont"><div class="columna_nivel1">'.nl2br($esta_columna).'</div><div class="columna_nivel2"></div></div>';
}
echo "</td></tr></table>";
echo "</form>";

mysqli_close($conexion);
 ?>