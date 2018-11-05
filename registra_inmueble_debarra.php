<?php
require_once "conector.php";
date_default_timezone_set("America/La_Paz");
$ids=explode(":",$_REQUEST["ids"]);
$pos=explode(":",$_REQUEST["pos"]);

$posfila=$pos[0];
$poscol=$pos[1];

$proyx=$ids[0];
$tipoinm=$ids[1];
$estadoinm=$ids[2];
$fecha_creacion=date('Y/m/d H:i:s');
$insertar="insert into inmuebles values('','$proyx','$tipoinm','$estadoinm','','$fecha_creacion','','','','','','','$posfila','$poscol','','')";
//echo $insertar."<br>";
$conexion->query($insertar);
$este_registro=$conexion->query("select id from inmuebles where fecha_creacion='$fecha_creacion' and proyectos_id='$proyx'");
$este_inmueble=$este_registro->fetch_row();
$idinmueble=$este_inmueble[0];
$consulta_join="select * from (select tb1.*,tipos_inmueble.icono from (select id,tipos_inmueble_id,estado from inmuebles where id='$idinmueble') as tb1 inner join tipos_inmueble on tb1.tipos_inmueble_id=tipos_inmueble.id) as tb2 inner join estados_inmueble on tb2.estado=estados_inmueble.id";
$resultado=$conexion->query($consulta_join);
$unregistro=$resultado->fetch_row();
$color_celda=explode(":",$unregistro[7]);
$clase_icono_garaje='fondo_icono icono_transparente';
$clase_icono_baulera='fondo_icono icono_transparente';
echo '<div class="div_inm" id="id_div_'.$posfila.'_'.$poscol.'" draggable="true" oncontextmenu="return muestra_menu_contextual(event,this)"><div class="cabecerainm" style="background-color:'.$color_celda[0].';color:'.$color_celda[2].'"><input type="hidden" name="id_inm_'.$posfila.'_'.$poscol.'" id="id_inm_'.$posfila.'_'.$poscol.'" value="'.$idinmueble.'"><div id="divlogo" style="background-image:url(\''.$unregistro[3].'\')"></div><span class="titulo_cabecera">'.$unregistro[5].'</span><a class="elim_inm">x</a></div><div id="contenido_caja_inm" style="background-color:'.$color_celda[1].';color:'.$color_celda[3].'"><div class="clase_usr"><div id="cliente_vendedor"><span class="link_usr">&nbsp;</span></div></div><div class="div_iconos"><div class="'.$clase_icono_garaje.'"><div class="icono_extra" style="background-image:url(\'images/garaje.png\')" title="Garaje"></div></div><div class="'.$clase_icono_baulera.'"><div class="icono_extra" style="background-image:url(\'images/baulera.png\')" title="Baulera"></div></div></div><div class="clase_cli"><div id="cliente_vendedor2"><span class="link_cliente">&nbsp;</span></div></div></div></div>';

mysqli_close($conexion);
?>