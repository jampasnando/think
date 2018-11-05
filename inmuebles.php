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
$resultado_estados=$conexion->query("select * from estados_inmueble");
while($un_estado=$resultado_estados->fetch_row())
{
	$acronimos_estado[$un_estado[0]]=$un_estado[2];
	$color_estado[$un_estado[0]]=$un_estado[3];
	$nombres_estado[$un_estado[0]]=$un_estado[1];
	$id_estados[]=$un_estado[0].":".$un_estado[1];
}
$resultado_tipos_inm=$conexion->query("select * from tipos_inmueble");
while($un_tipo_inm=$resultado_tipos_inm->fetch_row())
{
	$vector_tipos_inm[$un_tipo_inm[0]]=$un_tipo_inm[1];
	$vector_iconos_tipo[$un_tipo_inm[0]]=$un_tipo_inm[2];
}

?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
  <link rel="stylesheet" href="jquery-ui.min.css">
  <link rel="stylesheet" href="css/css_inm.css">
	<script src="jquery-3.3.1.min.js"></script>
    <script src="jquery-ui.min.js"></script>
    <script src="script/javascript_inm.js"></script>
    <script src="script/jquery.ui.touch-punch.min.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCwk67TfCngpCbeKFht2VX196hMohgH6Ws&callback=iniciamapa"
    async defer></script>
	
</head>

<body>
<div class="papa_contenedor_mapa">
<div class="contenedor_mapa" style="display: none;">
	<div class="div_mapa" id="div_mapa"></div>
	<div class="coordenadas">
	<label for="lat">Lat:</label>
	<input type="text" name="lat" id="lat" value="<?php echo $registroproy[4];?>">
	<label for="lon">Lng:</label>
	<input type="text" name="lon" id="lon" value="<?php echo $registroproy[5];?>">
	<input type="hidden" name="latx" id="latx" value="<?php echo $registroproy[4];?>">
	<input type="hidden" name="lonx" id="lonx" value="<?php echo $registroproy[5];?>">
	<input type="button" name="boton_marca" id="boton_marca" value="Guardar Ubicacion">
	</div>
</div>
</div>
<!-- ///////////menu contextual////////// -->
<div class="menu_contextual">
		<div class="titulo_menu_contextual">CAMBIAR ESTADO</div>
		<?php 
		$nroestados=count($id_estados);
		for($k=0;$k<$nroestados;$k++){
			echo '<div class="opcion_menu_contextual">'.$id_estados[$k].'</div>';
		}
		?>

</div>
<!-- /////////////////////////////////// -->
<div class="papa_barra">
<div class="barra">
	<div class="barra_tipos">
		<?php
			$res_estado=$conexion->query("select * from estados_inmueble where estado='Disponible'");
			$un_reg_estado=$res_estado->fetch_row();
			$colores_estado_disponible=explode(":", $un_reg_estado[3]);
			//$color_estado_disponible=$un_reg_estado[3];
			$resultado_tipos_inm->data_seek(0);
			while($un_tipo_inm=$resultado_tipos_inm->fetch_row())
			{
				
				echo '<div class="barra_un_tipo" id="'.$un_tipo_inm[0].'" draggable="true"><div class="div_inm" draggable="true"><div class="cabecerainm" style="background-color:'.$colores_estado_disponible[0].';color:'.$colores_estado_disponible[2].'"><input type="hidden" class="oculto" value="'.$proyecto.':'.$un_tipo_inm[0].':'.$un_reg_estado[0].'"><div id="divlogo" style="background-image:url(\''.$un_tipo_inm[2].'\')"></div></div><div id="contenido_caja_inm" style="background-color:'.$colores_estado_disponible[1].';color:'.$colores_estado_disponible[3].'"><span class="clase_usr"></span><div>Nuevo</div><span class="clase_cli"></span></div></div></div>';
			}
		?>

	</div>
	
</div>
<div class="boton_barra"></div>
</div>
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
      <td align="center" class="celda_menu"><a href="javascript:config('proyectos.php','1');">proyectos</a> | <a href="javascript:config('estados_proyecto.php','2')">estados_proyectos</a> | <a href="javascript:config('areascomunes.php','3')">areas_comunes</a> | <a href="javascript:config('tipos_inmueble.php','4')">tipos_inmueble</a> | <a href="javascript:config('estados_inmueble.php','5')">estados_inmueble</a> | <a href="javascript:config('ambientes_propios.php','6')">ambientes_propios</a> | <a href="javascript:config('usuarios.php','7')">usuarios</a> | <a href="javascript:config('tipos_usuario.php','8')">tipos_usuario</a> | <a href="javascript:config('clientes.php','9')">clientes</a> |</td>
      <td width="15%" align="right"><img src="images/usr_negro.png" class="icono_usr_sistema"> : <?php echo $nombre;?> | <a href="javascript:salir()">Salir</a></td>
    </tr>
  </table>
</form>
<table id="tb_titulo">
  <tr>
    <td></td>
    <td><?php echo $nombreproy;?>
    <input name="proyz" type="hidden" id="proyz" value="<?php echo $proyecto;?>"><input type="hidden" id="nombreproy" value="<?php echo $nombreproy;?>"></td>
    <td align="right">Nro de Inmuebles: <?php echo $nro_inmuebles;?></td>
  </tr>
</table></div>
<?php
if(isset($_REQUEST["proyectos"]))
{
?>
<table width="100%" border="0" id="tb_padre">
  <tr>
    <td valign="top">
    	<table width="100%" border="0">
        <tr>
          <td width="33%"><a href="javascript:masfila();"  class="masfila">+fila</a><input type="button" name="botonx2" id="botonx2" class="auxiliar"></td>
          <td width="33%">
          <?php
		  echo "<table id='color_estados'><tr>";
          $resultadocolores=$conexion->query("SELECT * FROM estados_inmueble left join (select estado, count(estado) from inmuebles where proyectos_id='$proyecto' group by estado) as tb1 on estados_inmueble.id=tb1.estado");
		  while($uncolor=$resultadocolores->fetch_row())
		  {
		  	if($uncolor[5]=="") $cant=0; else $cant=$uncolor[5];
		  	$esquema_color=explode(":", $uncolor[3]);
			echo "<td><div class='clase_estado_inm' style='background-color:".$esquema_color[1].";color:".$esquema_color[3]."'>".$uncolor[1]."[".$cant."]</div></td>";
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
					echo '<td><div class="columna_nivel1">'.$nombrecols_pordefecto[$k].'</div><div class="columna_nivel2"></div></td>';
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
			$color_celda=explode(":",$color_estado[$estado_celda]);
			$acronimo_celda=$acronimos_estado[$estado_celda];
			$nombre_estado_actual=$nombres_estado[$estado_celda];
			$id_tipo_inmueble=$un_registro[2];
			$tipo_inmueble=$vector_tipos_inm[$id_tipo_inmueble];
			$icono_tipo_inm=$vector_iconos_tipo[$id_tipo_inmueble];
			$id_inm=$un_registro[0];
			if($un_registro[18]=="") $mostrar_usr="<div id='cliente_vendedor'><span class='link_usr'>&nbsp;</span></div>"; else $mostrar_usr='<div id="cliente_vendedor"><img src="images/usr_azul.png" class="icon_usr"><a href="tel:'.$un_registro[19].'" class="link_usr">'.$un_registro[18].'-'.$un_registro[19].'</a></div>';
			
			if($un_registro[16]=="") $mostrar_cliente='<div id="cliente_vendedor2"><span class="link_cliente">&nbsp;</span></div>'; else $mostrar_cliente='<div id="cliente_vendedor2"><img src="images/usr_verde.png" class="icon_usr2"><a href="tel:'.$un_registro[17].'" class="link_cliente">'.$un_registro[16].'-'.$un_registro[17].'</a></div>';
			
			if($un_registro[14]!="") $clase_icono_garaje='fondo_icono';
			else $clase_icono_garaje='fondo_icono icono_transparente';
			if($un_registro[15]!="") $clase_icono_baulera='fondo_icono';
			else $clase_icono_baulera='fondo_icono icono_transparente';
			$matriz[$ff][$cc]='<td><div class="div_inm" id="id_div_'.$ff.'_'.$cc.'" draggable="true" oncontextmenu="return muestra_menu_contextual(event,this)"><div class="cabecerainm" style="background-color:'.$color_celda[0].';color:'.$color_celda[2].'"><input type="hidden" name="id_inm_'.$ff.'_'.$cc.'" id="id_inm_'.$ff.'_'.$cc.'" value="'.$id_inm.'"><div id="divlogo" style="background-image:url(\''.$icono_tipo_inm.'\')"></div><span class="titulo_cabecera">'.$nombre_estado_actual.'</span><a class="elim_inm">x</a></div><div id="contenido_caja_inm" style="background-color:'.$color_celda[1].';color:'.$color_celda[3].'"><div class="clase_usr">'.$mostrar_usr.'</div><div class="div_iconos"><div class="'.$clase_icono_garaje.'"><div class="icono_extra" style="background-image:url(\'images/garaje.png\')" title="Garaje"></div></div><div class="'.$clase_icono_baulera.'"><div class="icono_extra" style="background-image:url(\'images/baulera.png\')" title="Baulera"></div></div></div><div class="clase_cli">'.$mostrar_cliente.'</div></div></div></td>';
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
					if(strpos($colsx[$k],"@")!==false)
					{
						$niveles=explode("@", $colsx[$k]);
						$nivel1=nl2br($niveles[0]);
						$nivel2=nl2br($niveles[1]);
						echo '<td><div class="div_col_titulo"><div class="columna_nivel1">'.$nivel1.'</div><div class="columna_nivel2">'.$nivel2.'</div></div></td>';
					}
					else{
						echo '<td><div class="div_col_titulo"><div class="columna_nivel1">'.$colsx[$k].'</div><div class="columna_nivel2"></div></div></td>';
					}
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
	echo '<div class="logo"></div>';
?>
<div class="pie">
	<div id="pie_logo"></div>
    <?php 
	if(isset($_REQUEST["proyectos"]))
	{
	?>
    <div class="titulo_y_pievendedores">
    	<div class="titulo_pie_vendedoresyclientes">Vendedores:</div>
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
	</div>
    <hr/>
    <div class="titulo_y_pieclientes">
    	<div class="titulo_pie_vendedoresyclientes">Clientes:</div>
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