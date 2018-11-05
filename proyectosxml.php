<?php 
require_once "conector.php";
$docu=new DOMDocument("1.0");
$raiz=$docu->createElement("marcadores");
$nodoraiz=$docu->appendChild($raiz);
header("Content-type: text/xml");
$resultado=$conexion->query("select * from proyectos where not(latitud='') and not(longitud='')");
while($unregistro=$resultado->fetch_assoc()){
	$elemento=$docu->createElement("marcador");
	$nodo=$nodoraiz->appendChild($elemento);
	$nodo->setAttribute("id",$unregistro["id"]);
	$nodo->setAttribute("nombre",$unregistro["nombre"]);
	$nodo->setAttribute("direccion",$unregistro["direccion"]);
	$nodo->setAttribute("telefonos",$unregistro["telefonos"]);
	$nodo->setAttribute("latitud",$unregistro["latitud"]);
	$nodo->setAttribute("longitud",$unregistro["longitud"]);
	$nodo->setAttribute("fechareg",$unregistro["fechareg"]);
	$nodo->setAttribute("descripcion",$unregistro["descripcion"]);
	$nodo->setAttribute("estado",$unregistro["estado"]);
	$nodo->setAttribute("avance",$unregistro["avance"]);
	$nodo->setAttribute("textofilas",$unregistro["textofilas"]);
	$nodo->setAttribute("textocols",$unregistro["textocols"]);	
}
echo $docu->saveXML();
mysqli_close($conexion);
?>