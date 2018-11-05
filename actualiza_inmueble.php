<?php
require_once "conector.php";
date_default_timezone_set("America/La_Paz");

$id_inm=$_REQUEST["id_inm"];
$conexion->query("delete from inmuebles where id='$id_inm'");
$conexion->query("delete from ambientes_propios_inmueble where inmuebles_id='$id_inm'");
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
//$fecha_creacion=implode("/",array_reverse(explode("/",$_REQUEST["creado"])));
$fechacreado=explode(" ",$_REQUEST["creado"]);
$fechayhoracreado=implode("/",array_reverse(explode("/",$fechacreado[0])))." ".$fechacreado[1];

$cliente=$_REQUEST["cliente"];
$acuenta=$_REQUEST["acuenta"];
$moneda=$_REQUEST["moneda"];
$solohora=date("H:i:s");
$fechaini=$_REQUEST["fechaini"];
if($fechaini!="")
{
	if(strlen($fechaini)<11)
		$fechaini=implode("/",array_reverse(explode("/",$fechaini)))." ".$solohora;
	else
	{
		$vfechaini=explode(" ",$fechaini);
		$fechaini=implode("/",array_reverse(explode("/",$vfechaini[0])))." ".$vfechaini[1];
	}
}
$fechafin=$_REQUEST["fechafin"];
if($fechafin!="")
{
	if(strlen($fechafin)<11)
		$fechafin=implode("/",array_reverse(explode("/",$fechafin)))." ".$solohora;
	else
	{
		$vfechafin=explode(" ",$fechafin);
		$fechafin=implode("/",array_reverse(explode("/",$vfechafin[0])))." ".$vfechafin[1];
	}
}

$usuario=$_REQUEST["usuario"];
$garaje=$_REQUEST["garaje"];
$baulera=$_REQUEST["baulera"];

$insertar="insert into inmuebles values('','$proyx','$tipoinm','$estadoinm','$precio','$fechayhoracreado','$cliente','$usuario','$fechaini','$fechafin','$acuenta','$moneda','$posfila','$poscol','$garaje','$baulera')";
//echo $insertar."<br>";
$conexion->query($insertar);
$este_registro=$conexion->query("select id from inmuebles where fecha_creacion='$fechayhoracreado' and posfila='$posfila' and poscol='$poscol'");
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
		//echo $check."->".$valor."<br>";
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