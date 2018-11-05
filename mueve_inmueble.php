<?php
session_start();
require_once "conector.php";
$id=$_REQUEST["id"];
$fila=$_REQUEST["fila"];
$colu=$_REQUEST["colu"];

$conexion->query("update inmuebles set posfila='$fila',poscol='$colu' where id='$id'");
mysqli_close($conexion);
?>
