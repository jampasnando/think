<?php
session_start();
require_once "conector.php";
date_default_timezone_set("America/La_Paz");

$nombre=$_REQUEST["nombre"];
$direccion=$_REQUEST["direccion"];
$telefonos=$_REQUEST["telefonos"];
$latitud=$_REQUEST["latitud"];
$longitud=$_REQUEST["longitud"];
//$fechareg=$_REQUEST["fechareg"];
//$hora=date("H:i:s");
//$fechahorareg=$fechahorareg." ".$hora;
$fechahorareg=date("Y-m-d H:i:s");
$descripcion=$_REQUEST["descripcion"];
$estado=$_REQUEST["estado"];
$avance=$_REQUEST["avance"]."%";
//$textofilasinicial="4:3:2:1:PB";
//$textocolsinicial="A:B:C:D:E:F:G";
$letras=array("A","B","C","D","E","F","G","H","I","J","K","L","M","N","O","P","Q","R","S","T","U","V","W","X","Y","Z");
$filasx=$_REQUEST["filasx"];
$columnasx=$_REQUEST["columnasx"];
if(($filasx>0)&&($columnasx>0))
{
	for($k=($filasx-1);$k>=0;$k--)
	{
		if($k==0) 
			$vfilas[]="PB";
		else
			$vfilas[]=$k;
	}
	$textofilasinicial=implode(":",$vfilas);
	for($i=0;$i<$columnasx;$i++)
		$vcols[]=$letras[$i];
	$textocolsinicial=implode(":",$vcols);
	$conexion->query("insert into proyectos values('','$nombre','$direccion','$telefonos','$latitud','$longitud','$fechahorareg','$descripcion','$estado','$avance','$textofilasinicial','$textocolsinicial')");
	$ultimo_registro=$conexion->query("select id from proyectos where nombre='$nombre' and fechareg='$fechahorareg'");
	$unafila=$ultimo_registro->fetch_row();
	$id_proy=$unafila[0];
	$tipoinm=$_REQUEST["tipoinm"];
	$estadoinm=$_REQUEST["estadoinm"];
	$precio=$_REQUEST["precio"];
	$garaje=$_REQUEST["garaje"];
	$baulera=$_REQUEST["baulera"];
	for($i=1;$i<=$filasx;$i++)
	{
		for($j=0;$j<=$columnasx;$j++)
		{
			$posfila=$i;
			$poscol=$j;
			$insertar="insert into inmuebles values('','$id_proy','$tipoinm','$estadoinm','$precio','$fechahorareg','','','','','','','$posfila','$poscol','$garaje','$baulera')";
			$conexion->query($insertar);
			$este_registro=$conexion->query("select id from inmuebles where proyectos_id='$id_proy' and posfila='$posfila' and poscol='$poscol'");
			$este_inmueble=$este_registro->fetch_row();
			$idinmueble=$este_inmueble[0];
			if(isset($_REQUEST["ambientes"]))
			{
				$ambientes=$_REQUEST["ambientes"];
				$lambientes=count($ambientes);
				for($k=0;$k<$lambientes;$k++)
				{
					$checkyindice=explode(":",$ambientes[$k]);
					$check=$checkyindice[0];
					$indice=$checkyindice[1];
					$valor=$_REQUEST["valor_".$indice];
					echo $check."->".$valor."<br>";
					$conexion->query("insert into ambientes_propios_inmueble values('','$check','$idinmueble','$valor')");
				}
			}	
		}
	}
}
else
{
	$textofilasinicial="4:3:2:1:PB";
	$textocolsinicial="A:B:C:D:E:F:G";
	$conexion->query("insert into proyectos values('','$nombre','$direccion','$telefonos','$latitud','$longitud','$fechareg','$descripcion','$estado','$avance','$textofilasinicial','$textocolsinicial')");
}
mysqli_close($conexion);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body onload="document.getElementById('form_ir_inmueble').submit();">
	<form name="form_ir_inmueble" id="form_ir_inmueble" action="inmuebles.php" method="post">
		<input type="hidden" name="proyectos" value="<?php echo $id_proy;?>">
	</form>
</body>
</html>