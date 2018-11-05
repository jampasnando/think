<?php
session_start();
if(isset($_SESSION["nombre"]))
{
$nombre=$_SESSION["nombre"];
require_once "conector.php";
date_default_timezone_set("America/La_Paz");
if(isset($_REQUEST["proyectos"]))
{
	$proyecto=$_REQUEST["proyectos"];
	$proy=$conexion->query("select * from proyectos where id='$proyecto'");
	$registroproy=$proy->fetch_row();
	$nombreproy=$registroproy[1];
	$nnfilas=$registroproy[10];
	if($nnfilas!="")
		$filasx=explode(":",$nnfilas);
	$nncols=$registroproy[11];
	if($nncols!="")
		$colsx=explode(":",$nncols);
	$inmuebles=$conexion->query("select tb2.*,usuarios.nombre,usuarios.celular from (select tb1.*,clientes.nombre,clientes.celular from (select * from inmuebles where proyectos_id='$proyecto') as tb1 left join clientes on tb1.clientes_id=clientes.id) as tb2 left join usuarios on tb2.usuarios_id=usuarios.id");
	$nro_inmuebles=mysqli_num_rows($inmuebles);
	
}
else 
{
	$nombreproy="";
	$nro_inmuebles=0;
}
$colores_estados=$conexion->query("select * from estados_inmueble");
while($un_estado=$colores_estados->fetch_row())
{
	$acronimos_estado[$un_estado[0]]=$un_estado[2];
	$color_estado[$un_estado[0]]=$un_estado[3];
	$nombres_estado[$un_estado[0]]=$un_estado[1];
}
$resultado_tipos_inm=$conexion->query("select * from tipos_inmueble");
while($un_tipo_inm=$resultado_tipos_inm->fetch_row())
{
	$vector_tipos_inm[$un_tipo_inm[0]]=$un_tipo_inm[1];
}

?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
  <!--<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">-->
  <link rel="stylesheet" href="jquery-ui.min.css">
  <link rel="stylesheet" href="css/css_inm.css">
  	<!--<script src="https://code.jquery.com/jquery-1.12.4.js"></script>-->
	<script src="jquery-3.3.1.min.js"></script>
	<!--<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>-->
    <script src="jquery-ui.min.js"></script>
    <script src="jscolor.js"></script>
    <script src="script/javascript_inm.js"></script>
	
</head>

<body>

<div id="ventana">
  <table id="cabeceraventana">
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td id="equis"><a href="#" class="cerrar">Cerrar</a></td>
    </tr>
  </table>
  <div id="contenedor"></div>
</div>
<div id="ventana_config">
	<div id="cabecera_config">
		CONFIGURACION
        <span id="cerrar_config">Cerrar</span>
    </div>
    <div id="contenedor_config"></div>
</div>
<div id="fondo">
</div>
<div id="cabecera_pagina"><form name="form1" method="post" action="inmuebles.php" id="form1">
  <table width="100%" border="0">
    <tr>
      <td width="15%"><select name="proyectos" id="proyectos" onChange="envia();">
        <option value="">Elija Proyecto</option>
        <?php
  $proyectos=$conexion->query("select * from proyectos");
  while($filas=$proyectos->fetch_row())
  {
  	echo "<option value='".$filas[0]."'>".$filas[1]."</option>";
  }
  ?>
      </select>
      <input type="hidden" name="reloj" id="reloj"></td>
      <td align="center" class="celda_menu"><a href="javascript:config('proyectos.php','1');">proyectos</a> | <a href="javascript:config('estados_proyecto.php','2')">estados_proyectos</a> | <a href="javascript:config('areascomunes.php','3')">areas_comunes</a> | <a href="javascript:config('tipos_inmueble.php','4')">tipos_inmueble</a> | <a href="javascript:config('estados_inmueble.php','5')">estados_inmueble</a> | <a href="javascript:config('ambientes_propios.php','6')">ambientes_propios</a> | <a href="javascript:config('usuarios.php','7')">usuarios</a> | <a href="javascript:config('tipos_usuario.php','8')">tipos_usuairo</a> | <a href="javascript:config('clientes.php','9')">clientes</a> |</td>
      <td width="15%" align="right">Usuario : <?php echo $nombre;?></td>
    </tr>
  </table>
</form>
<table id="tb_titulo">
  <tr>
    <td>Nro de Inmuebles: <?php echo $nro_inmuebles;?></td>
    <td><?php echo $nombreproy;?>
    <input name="proyz" type="hidden" id="proyz" value="<?php echo $proyecto;?>"></td>
    <td>&nbsp;</td>
  </tr>
</table></div>
<?php
if(isset($_REQUEST["proyectos"]))
{
?>
<table width="100%" border="0" id="tb_padre">
  <tr>
    <td valign="top"><table width="100%" border="0">
        <tr>
          <td width="33%"><a href="javascript:masfila();">+fila</a></td>
          <td width="33%">
          <?php
		  echo "<table id='color_estados'><tr>";
          $resultadocolores=$conexion->query("SELECT * FROM estados_inmueble left join (select estado, count(estado) from inmuebles where proyectos_id='$proyecto' group by estado) as tb1 on estados_inmueble.id=tb1.estado");
		  while($uncolor=$resultadocolores->fetch_row())
		  {
		  	if($uncolor[5]=="") $cant=0; else $cant=$uncolor[5];
			echo "<td bgcolor='#".$uncolor[3]."'><div class='clase_estado_inm'>".$uncolor[1]."(".$cant.")</div></td>";
		  }
		  echo '<td><a href="javascript:config(\'estados_inmueble.php\',\'5\')"><img src="images/logo_config.png" id="img_config"></a></td></tr></table>';
		  ?>
          </td>
          <td width="33%" align="right"><a href="javascript:mascolumna();">+columna</a></td>
        </tr>
      </table>
<?php
      if(($registroproy[10]=="")&&($registroproy[11]==""))
	  {
		$nombrecols_pordefecto=array('','A','B','C','D','E','F','G');
		$nro_nombrecols=count($nombrecols_pordefecto);
		$nroplantas_pordefecto=4;
		echo '<table id="tb1">';
		for($i=($nroplantas_pordefecto+1);$i>=0;$i--)
		{
			echo '<tr>';
			if($i==($nroplantas_pordefecto+1))
				echo '<td>&nbsp;</td>';
			else
				if($i==0)
					echo '<td>PB</td>';
				else
					echo '<td>'.$i.'</td>';
			for($k=1;$k<$nro_nombrecols;$k++)
			{
				if($i==($nroplantas_pordefecto+1))
				{
					echo '<td>'.$nombrecols_pordefecto[$k].'</td>';
				}
				else
					echo '<td>&nbsp;</td>';
			}
		}
		echo '</table>';
	  }
	  else
	  {
	  	$nro_filas=count($filasx);
		$nro_cols=count($colsx);
		for($s=0;$s<=+$nro_filas;$s++)
		{
			for($t=0;$t<=$nro_cols;$t++)
				$matriz[$s][$t]="<td></td>";
		}
		while($un_registro=$inmuebles->fetch_row())
		{
			//$pos=explode("#",$un_registro[12]);
			$ff=$un_registro[12];
			$cc=$un_registro[13];
			//$matriz[$ff][$cc]=$un_registro[3];
			$estado_celda=$un_registro[3];
			$color_celda=$color_estado[$estado_celda];
			$acronimo_celda=$acronimos_estado[$estado_celda];
			$nombre_estado_actual=$nombres_estado[$estado_celda];
			$id_tipo_inmueble=$un_registro[2];
			$tipo_inmueble=$vector_tipos_inm[$id_tipo_inmueble];
			$id_inm=$un_registro[0];
			if($un_registro[16]=="") $mostrar_usr="<div id='cliente_vendedor'><span class='link_usr'>&nbsp;</span></div>"; else $mostrar_usr='<div id="cliente_vendedor"><img src="images/usr_azul.png" class="icon_usr"><a href="#" class="link_usr">'.$un_registro[16].'-'.$un_registro[17].'</a></div>';
			
			if($un_registro[14]=="") $mostrar_cliente='<div id="cliente_vendedor2"><span class="link_cliente">&nbsp;</span></div>'; else $mostrar_cliente='<div id="cliente_vendedor2"><img src="images/usr_verde.png" class="icon_usr2"><a href="#" class="link_cliente">'.$un_registro[14].'-'.$un_registro[15].'</a></div>';
			
			//$matriz[$ff][$cc]='<td bgcolor="#'.$color_celda.'"><div id="div_inm"><div class="cabecerainm"><div id="divlogo"></div>'.$tipo_inmueble.'</div><div id="contenido_caja_inm"><input type="hidden" name="id_inm_'.$ff.'_'.$cc.'" id="id_inm_'.$ff.'_'.$cc.'" value="'.$id_inm.'"><div id="acronimo_estado_inm">'.$nombre_estado_actual.'</div></div></div></td>';
			//$matriz[$ff][$cc]='<td bgcolor="#'.$color_celda.'"><div id="div_inm"><div class="cabecerainm"><div id="divlogo"></div><div class="nombre_tipo_inm">'.$tipo_inmueble.'</div><div class="elim_inm">x</div></div><div id="contenido_caja_inm"><input type="hidden" name="id_inm_'.$ff.'_'.$cc.'" id="id_inm_'.$ff.'_'.$cc.'" value="'.$id_inm.'"><span class="clase_usr">'.$mostrar_usr.'</span><div class="acronimo_estado_inm">'.$nombre_estado_actual.'</div><span class="clase_cli">'.$mostrar_cliente.'</span></div></div></td>';
			$matriz[$ff][$cc]='<td><div class="div_inm" id="id_div_'.$ff.'_'.$cc.'" draggable="true" style="background-color:#'.$color_celda.'"><div class="cabecerainm"><input type="hidden" name="id_inm_'.$ff.'_'.$cc.'" id="id_inm_'.$ff.'_'.$cc.'" value="'.$id_inm.'"><div id="divlogo"></div>'.$tipo_inmueble.'<a class="elim_inm">x</a></div><div id="contenido_caja_inm"><span class="clase_usr">'.$mostrar_usr.'</span><div class="acronimo_estado_inm">'.$nombre_estado_actual.'</div><span class="clase_cli">'.$mostrar_cliente.'</span></div></div></td>';
		}
		//print_r($matriz);
		echo '<table id="tb1">';
		for($i=0;$i<=$nro_filas;$i++)
		{
			echo '<tr>';
			if($i==0)
			{
				echo '<td>&nbsp;</td>';
				for($k=0;$k<$nro_cols;$k++)
				{
					echo '<td>'.nl2br($colsx[$k]).'</td>';
				}
			}
			else
			{
				echo '<td>'.nl2br($filasx[$i-1]).'</td>';
				for($k=1;$k<=$nro_cols;$k++)
				{
					echo $matriz[$i][$k];
				}
			}
		}
	  }
	  ?>
      
     <table width="100%" border="0">
        <tr>
          <td>Nombre Fila
            <input name="borrafila" type="text" id="borrafila" size="3">
          <a href="javascript:borrafila();">Borrar</a></td>
          <td align="right">Nombre Columna
            <label for="borrafila"></label>
            <input name="borracol" type="text" id="borracol" size="3">
          <a href="javascript:borracol();">Borrar</a></td>
        </tr>
      </table>
    <p>&nbsp;</p>
<input name="proyecto" type="hidden" id="proyecto" value="<?php echo $proyecto;?>">
    <p>&nbsp;</p>
    </td>
    <td valign="top" bgcolor="#FFFFCC">
    
    </td>
  </tr>
</table>
<?php
}
else
	echo '<div id="logo"></div>';
?>
<div class="pie">
	<div id="pie_logo"></div>
    <?php 
	if(isset($_REQUEST["proyectos"]))
	{
	?>
    <div id="pie_vendedores">
    <?php
    $resultado=$conexion->query("SELECT id,nombre, sum(if(usuarios_id>0,1,0)) from usuarios left join (select usuarios_id from inmuebles where proyectos_id='$proyecto') as tb1 on usuarios.id=tb1.usuarios_id group by usuarios_id");
    echo "<ul>";
    while($unafila=$resultado->fetch_row())
    {
        if($unafila[2]>0)
            echo "<li><a class='clase_link_usr'>".$unafila[1]."[".$unafila[2]."]</a></li>";
    }
    echo "</ul>";
    ?>
    </div>
    <div id="pie_clientes">
		<?php
        $resultado=$conexion->query("SELECT id,nombre,sum(if(clientes_id>0,1,0)) FROM clientes left join (select clientes_id from inmuebles where proyectos_id='$proyecto') as tb1 on clientes.id=tb1.clientes_id group by id");
        echo "<ul>";
        while($unafila=$resultado->fetch_row())
        {
            if($unafila[2]>0)
                echo "<li><a class='clase_link_cli'>".$unafila[1]."[".$unafila[2]."]</a></li>";
        }
        echo "</ul>";
        mysqli_close($conexion);
        ?>
    </div>
    <?php }?>
</div>
<?php
}
else
header("Location:index.php");
?>
</body>
</html>