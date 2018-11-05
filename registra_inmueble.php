<?php
require_once "conector.php";
date_default_timezone_set("America/La_Paz");

$plantax=$_REQUEST["plantax"];
$columnax=$_REQUEST["columnax"];
//$posicion=$plantax."#".$columnax;
$posfila=$_REQUEST["posfila"];
$poscol=$_REQUEST["poscol"];
//$posicion=$posfila."#".$poscol;
//echo $posicion."<br>";
$proyx=$_REQUEST["proyx"];
$tipoinm=$_REQUEST["tipoinm"];
$estadoinm=$_REQUEST["estadoinm"];
$precio=$_REQUEST["precio"];
//$fecha_creacion=$_REQUEST["fecha_creacion"];
$fecha_creacion=date('Y/m/d H:i:s');
$cliente=$_REQUEST["cliente"];
$acuenta=$_REQUEST["acuenta"];
$moneda=$_REQUEST["moneda"];
$fechaini=$_REQUEST["fechaini"];
$fechafin=$_REQUEST["fechafin"];
$usuario=$_REQUEST["usuario"];
$garaje=$_REQUEST["garaje"];
$baulera=$_REQUEST["baulera"];
//echo $plantax."--".$columnax."--".$proyx."--".$tipoinm."--".$estadoinm."<br>";
//print_r($ambientes);
$insertar="insert into inmuebles values('','$proyx','$tipoinm','$estadoinm','$precio','$fecha_creacion','$cliente','$usuario','$fechaini','$fechafin','$acuenta','$moneda','$posfila','$poscol','$garaje','$baulera')";
//echo $insertar."<br>";
$conexion->query($insertar);
$este_registro=$conexion->query("select id from inmuebles where fecha_creacion='$fecha_creacion' and proyectos_id='$proyx'");
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
mysqli_close($conexion);
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
</head>

<body onLoad="document.getElementById('form1').submit();">
<form name="form1" id="form1" method="post" action="inmuebles.php">
  <input name="proyectos" type="hidden" id="proyectos" value="<?php echo $proyx;?>">
</form>
</body>
</html>