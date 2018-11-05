<?php
require_once "conector.php";
$resultado_tipos_inm=$conexion->query("select * from tipos_inmueble");
while($un_tipo_inm=$resultado_tipos_inm->fetch_row())
{
	$vector_tipos_inm[$un_tipo_inm[0]]=$un_tipo_inm[1];
}
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
<style type="text/css">
html,body{
	margin:0;
	height: 100%;
}
.papa_barra{
	position: fixed;
	height: 100%;
	top:50px;
}
.barra{
	width: 100px;
	height:100%;
	overflow: hidden;
	background-color: #dff9fb;
	margin-left: -100px;
	transition: .8s all;
	float:left;
}
.muestra{
	margin:0;
}
.barra_tipos{
	margin: 0;
	padding: 0;

}
.barra_un_tipo{
	list-style: none;
	height: 60px;
	display: flex;
	justify-content: center;
	margin:10px;
	color:blue;
	cursor: pointer;
	overflow: hidden;
	display: flex;
	flex-direction: column;
	align-content: center;
	text-align: center;
}
.barra_un_tipo:hover{
	border:1px solid blue;
}
.boton_barra{
	cursor: pointer;
	background-image: url("images/menu.png");
	height:40px;
	width:40px;
	background-size: contain;
	float: left;
}
.iconox{
	background-image: url("images/Cross.png");
}
.boton_barra:hover{
	background-color:#dff9fb; 
}
td{
	width:50px;
	height: 100px;
	border: 1px solid black;
}
</style>
	<script src="jquery-3.3.1.min.js"></script>

<script type="text/javascript">
	$(document).ready(inicio);
	function inicio(){
		arrastrando_objeto="";
		$(".boton_barra").click(aparece);
		$('.barra_un_tipo').on("dragstart", function (event) {
			  var dt = event.originalEvent.dataTransfer;
			  dt.setData('Text', $(this).attr('id'));
			  arrastrando_objeto="objetobarra";
			});
	    $('#tb1 td').on("dragenter dragover drop", function (event) {	
		   event.preventDefault();
		   if (event.type === 'drop') {
			  var data = event.originalEvent.dataTransfer.getData('Text',$(this).attr('id'));
			  if($(this).find('div').length===0){
				  if(arrastrando_objeto=="objetobarra"){
				   //de=$('#'+data).detach();
				   de=$('#'+data).clone();
				   de.appendTo($(this));
				   $("#"+data).addClass("blink");
				   var fila=$("#"+data).parent().parent().index();
				   var colu=$("#"+data).parent().index();
				   //var idx=$("#"+data+" .cabecerainm input").val();
				   //$("#"+data+" .cabecerainm input").attr("id","id_inm_"+fila+"_"+colu)
				   //$("#"+data).attr("id","id_div_"+fila+"_"+colu);

				   // $.ajax({
				   // 	url:"mueve_inmueble.php",
				   // 	data:{id:idx,fila:fila,colu:colu},
				   // 	type:"POST",
				   // 	success:function(resultado){
				   // 		$("#"+"id_div_"+fila+"_"+colu).removeClass("blink");
				   // 	}
				   // })
				   
				   //$("#"+data + " input").attr("id","id_inm_"+fila+"_"+colu);
				   //alert($("#"+data+" .cabecerainm input").attr("id"));
				   //alert(fila+"--"+colu);
					}
				}
			 
		   };
	   });

	}
	function aparece(){
		$(".barra").toggleClass("muestra");
		$(".boton_barra").toggleClass("iconox");
	}
</script>
</head>
<body>
<div class="papa_barra">
<div class="barra">

	<div class="barra_tipos">
		<?php
			$resultado_tipos_inm->data_seek(0);
			while($un_tipo_inm=$resultado_tipos_inm->fetch_row())
			{
				echo '<div class="barra_un_tipo" id="'.$un_tipo_inm[0].'" draggable="true">'.$un_tipo_inm[1].'</div>';
			}
		?>

	</div>
	
</div>
<div class="boton_barra"></div>
</div>
<table id="tb1">
	<tr><td></td><td></td><td></td><td></td></tr>
	<tr><td></td><td></td><td></td><td></td></tr>
	<tr><td></td><td></td><td></td><td></td></tr>
	<tr><td></td><td></td><td></td><td></td></tr>
	<tr><td></td><td></td><td></td><td></td></tr>
	<tr><td></td><td></td><td></td><td></td></tr>
	<tr><td></td><td></td><td></td><td></td></tr>
	<tr><td></td><td></td><td></td><td></td></tr>
	<tr><td></td><td></td><td></td><td></td></tr>
	<tr><td></td><td></td><td></td><td></td></tr>
</table>

<div class="div_inm" id="id_div_3_4" draggable="true" style="background-color:#CAFFFF">
	<div class="cabecerainm">
		<input type="hidden" name="id_inm_3_4" id="id_inm_3_4" value="109">
		<div id="divlogo"></div>
		Departamento
		<a class="elim_inm">x</a>
	</div>
	<div id="contenido_caja_inm">
		<span class="clase_usr"></span>
		<div class="acronimo_estado_inm">Disponible</div>
		<span class="clase_cli"></span>
	</div>
</div>

</body>
</html>