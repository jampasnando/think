// JavaScript Document
marcadores=[];
$(document).ready(inicio);
function inicio()
{
	bandera="si";
	window.onclick=oculta_menu_contextual;
	if($("#tb1").length>0)
	{
		arrastrando_objeto="";
		celdax=document.getElementById("tb1").rows[0].cells[0];
		$("#tb1 td").click(eligecelda); 
		var tiempo=setInterval(ponehora,40000);
		$(".clase_link_usr").click(resalta_inm_de_usr);
		$(".clase_link_cli").click(resalta_inm_de_cli);
		$(".clase_estado_inm").click(resalta_estado_inm);
		$(".elim_inm").click(elimina_inm);
		$(".opcion_menu_contextual").click(cambia_estado_inm);
		$(".div_col_titulo").click(edita_col_titulo);

/////////////////////////////////////////////////////////////////////////////////
		$(".boton_barra").click(aparece);
		$('.barra_un_tipo').on("dragstart", function (event) {
			  var dt = event.originalEvent.dataTransfer;
			  dt.setData('Text', $(this).attr('id'));
			  arrastrando_objeto="objetobarra";
			});
		$('.div_inm').on("dragstart", function (event) {
			  var dt = event.originalEvent.dataTransfer;
			  dt.setData('Text', $(this).attr('id'));
			  arrastrando_objeto="objetoexistente";
			});
	    $('#tb1 td').on("dragenter dragover drop", function (event) {	
		  recibe_inm_arrastrado(event,this);

	   });
/////////////////////////////////////////////////////////////////////////////////
	}
	$(".cerrar").click(function (e1){
		$("#ventana").fadeOut(500);
		$("#fondo").fadeOut(500);
		$(celdax).css("border","");
		bandera="si";
	});
	$("#cerrar_config").click(function(e2){
		if($("#contenedor_config").has(".contenedor_mapa").length>0){
			$(".contenedor_mapa").toggle();
			$(".papa_contenedor_mapa").append($(".contenedor_mapa"));
		}
		
		$("#ventana_config").fadeOut(500);
		$("#fondo").fadeOut(500);
		bandera="si";
	});
	esquema_actual="";
	$("#tb1 tr:first-child td:first-child").click(celdacero);
	$("#ventana_config").draggable();
	$(".auxiliar").click(muestra_vector_marcadores);
	$("#boton_marca").click(guarda_coordenadas);
	
}
function muestra_vector_marcadores(){
	var nro=marcadores.length;
	alert(nro);
	//alert(marcadores[0].position);
}
function celdacero(){
	$("#ventana_config").draggable("disable");
	$("#contenedor_config").empty();
	$("#ventana_config").fadeIn(500);
	$("#fondo").fadeTo(500, 0.5).css('display', 'block');
	bandera="no";
	$("#contenedor_config").append($(".contenedor_mapa"));

	$(".contenedor_mapa").toggle();
	var latx=$("#latx").val();
	var lonx=$("#lonx").val();
	
	if((latx!="")&&(lonx!="")){
		latx=parseFloat(latx);
		lonx=parseFloat(lonx);
		mapa.setCenter({lat:latx,lng:lonx});
		$(".coordenadas").css("display","none");
		$("div.pin").css("display","none");
		//marca();
	}
	else{
		google.maps.event.addListener(mapa,'center_changed', function() {
			var latitud = mapa.getCenter().lat();
			var longitud = mapa.getCenter().lng();
			$("#lat").val(latitud);
			$("#lon").val(longitud);
		});
		
		$(".coordenadas").css("display","");
		$("div.pin").css("display","");
	}

}
function guarda_marcasmapa_en_vector(){
	var lat=$("#latx").val();
	var lon=$("#lonx").val();
	obtenerxml('proyectosxml.php', function(data) {
		//alert(data.responseText);
		if(data.responseXML.documentElement.getElementsByTagName('marcador').length==0){
		}
		else{
		  var xml = data.responseXML;
		  var markers = xml.documentElement.getElementsByTagName('marcador');
		  //var  grupo = new google.maps.LatLngBounds();

		  Array.prototype.forEach.call(markers, function(markerElem) {
			    var id = markerElem.getAttribute('id');
			    var name = markerElem.getAttribute('nombre');
			    var address = markerElem.getAttribute('direccion');
			    //var type = markerElem.getAttribute('type');
			    var point = new google.maps.LatLng(
			        parseFloat(markerElem.getAttribute('latitud')),
			        parseFloat(markerElem.getAttribute('longitud'))
			        );

			    if((lat==markerElem.getAttribute("latitud"))&&(lon==markerElem.getAttribute("longitud")))
			    	icono="images/icon_actual.png";
			    else
			    	icono="images/icon3.png"
			    var contenido_emergente="<div class='ventana_marca'><input type='hidden' name='id_proyx' id='id_proyx' value='"+id+"'><img src='images/logothink40px.png'><h2><a href='JavaScript:abre_proyecto_desde_mapa("+id+")'>"+name+"</a></h2><a href='javascript:borrar_marcador_mapa(\""+point+"\","+id+")'>Borrar</a>"+point+"</div>";
			    var marker = new google.maps.Marker({
			     //map: mapa,
			      position: point,
			      icon:icono,
			      zoom:17
			   	});

			   	emergente = new google.maps.InfoWindow;
			   	marker.addListener('click', function() {
		        emergente.setContent(contenido_emergente);
		        emergente.open(mapa, marker);
		      	});
		      	marcadores.push(marker);
			    
	 		})
			dibuja_marcas();

	  	}
	 })
}
function dibuja_marcas(){
	for(k=0;k<marcadores.length;k++){
		marcadores[k].setMap(mapa);
	}
}
function borrar_marcador_mapa(posicion,id){

		var proy_actual=$("#proyz").val();
		for(k=0;k<marcadores.length;k++){
			if(posicion==marcadores[k].position){
				if(confirm("Está seguro de Borrar las coordenadas de este punto?")){
					marcadores[k].setMap(null);
					marcadores.splice(k,1);
					if(proy_actual==id){
						$("#latx").val("");
						$("#lonx").val("");
					}
					$.ajax({
						url:"borra_coordenadas_proy.php",
						data:{id_proy:id},
						type:"POST",
						success:function(resultado){
							
						}
					})
				}
			}
		}
	
}
function abre_proyecto_desde_mapa(id_proy){
	//alert(id_proy);
	$("#proyectos").val(id_proy);
	$("#form1").submit();

}
function obtenerxml(url,callback) {
		 var request = window.ActiveXObject ?
		     new ActiveXObject('Microsoft.XMLHTTP') :
		     new XMLHttpRequest;

		 request.onreadystatechange = function() {
		   if (request.readyState == 4) {
		     request.onreadystatechange = nohacernada;
		     callback(request, request.status);
		   }
		 };

		 request.open('POST', url, true);
		 request.send(null);
	}
	
function nohacernada(){}

function iniciamapa(){
	mapa=new google.maps.Map(document.getElementById("div_mapa"),{
		center:{lat:-17.3731769,lng:-66.1491599},
		zoom:15
	})
	$('<div/>').addClass('pin').appendTo(mapa.getDiv()).click(function(){
           var that=$(this);
           if(!that.data('win')){
            that.data('win',new google.maps.InfoWindow({content:'Arrastrar el mapa para poner este pin en el punto deseado'}));
            that.data('win').bindTo('position',mapa,'center');
           }
           that.data('win').open(mapa);
        });
	
	guarda_marcasmapa_en_vector();
}

function guarda_coordenadas(){
		if(confirm("Está seguro de guardar estas coordenadas para este PROYECTO ?")){
		//alert("aceptaste");
		var lat=parseFloat($("#lat").val());
		var lon=parseFloat($("#lon").val());
		var id_proy=$("#proyz").val();
		$("#latx").val(lat);
		$("#lonx").val(lon);
		marcanuevo();
		$.ajax({
			url:"actualiza_coordenadas.php",
			data:{lat:lat,lon:lon,id_proy:id_proy},
			type:"POST",
			success:function (resultado){
				if(resultado=="exito"){
					
					
					$("div.pin").css("display","none");
					$(".coordenadas").css("display","none");
				}
			}
		})
		//$(".coordenadas").toggle();

	}
	//else{
		//vector_marcas[0].setMap(null);
		//$("div.pin").css("display","");
	//}
}
function marcanuevo(){
			//alert("hola");
			var lat=parseFloat($("#latx").val());
			var lon=parseFloat($("#lonx").val());
			var coordenadas = new google.maps.LatLng(lat,lon);
			var id=$("#proyz").val();
			//alert(lat+"--"+lon);
			var mi_icono="images/icon_actual.png";
			var nuevamarca=new google.maps.Marker({
				position:coordenadas,
				//map:mapa,
				icon:mi_icono,
			})
			var contenido_emergente="<div class='ventana_marca'><img src='images/logothink40px.png'><h2>"+$("#nombreproy").val()+"</h2><a href='javascript:borrar_marcador_mapa(\""+coordenadas+"\","+id+")'>Borrar</a></div>";
			var emergente=new google.maps.InfoWindow({
				content:contenido_emergente
			})
			nuevamarca.addListener("click",function(){
				emergente.open(mapa,nuevamarca);
			});
			//vector_marcas[0]=nuevamarca;
			marcadores.push(nuevamarca);
			dibuja_marcas();
	}
function edita_col_titulo(event){
	event.stopPropagation();
	var id_proy=$("#proyecto").val();
	var nro_col=$(this).parent().index();
	$("#contenedor_config").empty();
	$("#ventana_config").draggable("enable");
	$("#ventana_config").fadeIn(500);		//$("#ventana").css("display","block");
	$("#fondo").fadeTo(500, 0.5).css('display', 'block');
	$("#ventana_config").draggable();
	$.ajax({
		url:"gestiona_columna.php",
		data:{id_proy:id_proy,nro_col:nro_col},
		type:"POST",
		success: function(resultado){
			$("#contenedor_config").append(resultado);
			$(".propagador_precios").click(propaga_precio);
			$(".propagador_adicion").click(propaga_adicion);
			$(".propagador_porcentaje").click(propaga_porcentaje);
			$(".div_col_titulo2 .columna_nivel1").click(edita_nivel1);
			$(".div_col_titulo2 .columna_nivel2").click(edita_nivel2);
			//$(".boton_envia").click(envia_form_editor_cols);
		}
	})
}

function edita_nivel1(){
	contenido=$(this).text();
	$(this).unbind();
	//alert(contenido);
	var editor='<textarea name="editor_nivel1" id="editor_nivel1">'+contenido+'</textarea>';
	$(this).empty();
	$(this).append(editor);
}
function edita_nivel2(){
	contenido=$(this).text();
	$(this).unbind();
	//alert(contenido);
	var editor='<textarea name="editor_nivel2" id="editor_nivel2">'+contenido+'</textarea>';
	$(this).empty();
	$(this).append(editor);
}
function muestra_grilla_colores(){
	var id_reg=$(this).parent().find(":input").val();
	$(esquema_actual).removeClass("blink");
	$(this).addClass("blink");
	esquema_actual=this;
	//alert(id_reg);
	$(".contenedor_grilla_colores").load("grilla_colores.php",function(e){
		$(".unesquema").click(function(e){
			elige_esquema(this,id_reg)
		});
	})

}
function elige_esquema(obj,id_reg){
	var c1=$(obj).find(".color1").css("background-color");
	var c2=$(obj).find(".color1").css("color");
	var c3=$(obj).find(".color2").css("background-color");
	var c4=$(obj).find(".color2").css("color");
	var esquema=c1+":"+c3+":"+c2+":"+c4;
	//alert(esquema);
	if(confirm("Está seguro de cambiar el esquema parpadeante???")){
		$.ajax({
			url:"actualiza_esquema_color.php",
			data:{id_reg:id_reg,esquema:esquema},
			type:"POST",
			success:function(resultado){
				if(resultado=="exito"){
					$(esquema_actual).removeClass("blink");
					$(esquema_actual).find(".color1").css({"background-color":c1,"color":c2});
					$(esquema_actual).find(".color2").css({"background-color":c3,"color":c4});
					$(".contenedor_grilla_colores").empty();
				}
				else
					alert(resultado);	

			}
		})
	}
	//alert(id_reg+"::"+c1+"--"+c2+"--"+c3+"--"+c4);
}
function cambia_estado_inm(){
	var id_inm=id_inm_contextual;
	var opcion_elegida=$(this).text();
	var partes=opcion_elegida.split(":");
	var id_estado=partes[0];
	var texto=partes[1];
	$.ajax({
		url:"actualiza_estado_inm_contextual.php",
		data:{id_inm:id_inm,id_estado:id_estado},
		type:"POST",
		success:function(resultado){
			var colores=resultado.split(":");
			$(inmueble_contextual).find("#contenido_caja_inm").css({"background-color":colores[1],"color":colores[3]});
			$(inmueble_contextual).find(".cabecerainm").css({"background-color":colores[0],"color":colores[2]});
			
			//$(inmueble_contextual).css("background-color",resultado);
			$(inmueble_contextual).find(".titulo_cabecera").text(texto);
		}
	})
	//alert(opcion);

}
function recibe_inm_arrastrado(event,obj){
event.preventDefault();
		   if (event.type === 'drop') {
			  var data = event.originalEvent.dataTransfer.getData('Text',$(obj).attr('id'));
			  if($(obj).find('div').length===0){
					if(arrastrando_objeto=="objetobarra"){
					   de=$('#'+data).clone();
					   de.appendTo($(obj));
					   de.addClass("blink");

					   var fila=$(obj).parent().index();
					   var colu=$(obj).index();

					   ids=$(obj).find(".oculto").val();
					   pos=fila+":"+colu;
					   $.ajax({
					   		url:"registra_inmueble_debarra.php",
					   		data:{ids:ids,pos:pos},
					   		type:"POST",
					   		success:function(resultado){
					   			var celda=de.parent();
					   			de.parent().empty();
					   			celda.append(resultado);
					   			$(".elim_inm").click(elimina_inm);
								$('.div_inm').on("dragstart", function (event) {
								  var dt = event.originalEvent.dataTransfer;
								  dt.setData('Text', $(this).attr('id'));
								  arrastrando_objeto="objetoexistente";
								});					   			

					   		}
					   })

					}
					else{
					   de=$('#'+data).detach();
					   de.appendTo($(obj));
					   $("#"+data).addClass("blink");
					   var fila=$("#"+data).parent().parent().index();
					   var colu=$("#"+data).parent().index();
					   var idx=$("#"+data+" .cabecerainm input").val();
					   $("#"+data+" .cabecerainm input").attr("id","id_inm_"+fila+"_"+colu)
					   $("#"+data).attr("id","id_div_"+fila+"_"+colu);

					   $.ajax({
					   	url:"mueve_inmueble.php",
					   	data:{id:idx,fila:fila,colu:colu},
					   	type:"POST",
					   	success:function(resultado){
					   		$("#"+"id_div_"+fila+"_"+colu).removeClass("blink");
					   	}
					   })
					   

					}
				}
			 
		   };	
}
function aparece(){
	$(".barra").toggleClass("muestra");
	$(".boton_barra").toggleClass("iconox");
}
function elimina_proy(e){
	var idproyecto=$(this).find(":input").val();
	var nombreproy=$(this).parent().parent().find("td:eq(1) a").html();
	if(confirm("Está seguro de ELIMINAR el proyecto "+nombreproy+"?\nSe eliminarán TODOS LOS INMUEBLES que contiene"))
	{
		if(confirm(">>>XXX ESTÁ SEGURO DE ELIMINAR EL PROYECTO: " + nombreproy+"???<<<XXX\n\nSE ELIMINARÁ TODO EL CONTENIDO RELACIONADO\n\nCON ESTE PROYECTO\n\n\n\nSI NO ESTÁ SEGURO APRETE CANCELAR\n\n\n\n\n"))
		{
			$.ajax({
				url:"elimina_proyecto.php",
				data:{idproyecto:idproyecto},
				type:"POST",
				success:function(resultado){
					//alert(resultado);
					window.location="inmuebles.php";
				}
			})
		}
	}
}
function elimina_inm(event){
	event.stopPropagation();
	var fila=this.parentElement.parentElement.parentElement.parentElement.rowIndex;
	var col=this.parentElement.parentElement.parentElement.cellIndex;
	//alert(fila+"--"+col);
	var id_inm=$(this).parent().find(":input").val();
	proy=$("#proyecto").val();
	if(confirm("Está seguro de ELIMINAR ESTE INMUEBLE con id="+id_inm+" ?"))
	{
		$.ajax({
			url:"elimina_inmueble.php",
			data:{id_inm:id_inm,proy:proy},
			type:"POST",
			success: function(resultado){
				document.getElementById("tb1").rows[fila].cells[col].innerHTML="";
				document.getElementById("tb1").rows[fila].cells[col].bgColor="";				
			}
		});
	}
}
function resalta_inm_de_usr()
{
	var usr=this.innerHTML;
	nombreycantidad=usr.split("[");
	solonombreusr=nombreycantidad[0];
	$(this).toggleClass("blink");
	$(".link_usr").each(function(index, element) {
        dentrospan=element.innerHTML.split("-");
		solonombredentrospan=dentrospan[0];
		if(solonombreusr!=solonombredentrospan)
			$(element.parentElement.parentElement.parentElement.parentElement).toggle(500);
    });
	
}
function resalta_inm_de_cli()
{
	var cli=this.innerHTML;
	nombreycantidad=cli.split("[");
	solonombrecli=nombreycantidad[0];
	$(this).toggleClass("blink");
	$(".link_cliente").each(function(index, element) {
        dentrospan=element.innerHTML.split("-");
		solonombredentrospan=dentrospan[0];
		if(solonombrecli!=solonombredentrospan)
			$(element.parentElement.parentElement.parentElement.parentElement).toggle(500);
    });
	
}
function resalta_estado_inm()
{
	var estado=this.innerHTML;
	nombreycantidad=estado.split("[");
	solonombreestado=nombreycantidad[0];
	$(this).toggleClass("blink");
	$("#tb1 .cabecerainm .titulo_cabecera").each(function(index, element) {
        //dentro=element.innerHTML;
		dentro=$(element).text();
		//alert(dentro);
		if(solonombreestado.toUpperCase()!=dentro.toUpperCase())
			$(element.parentElement.parentElement).toggle(500);
    });
	
}

function ponehora()
{
	ahora=new Date();
	document.getElementById("reloj").value=ahora.getSeconds();
	if(bandera=="si")
		window.location.reload();
	else
		tiempo=setInterval(ponehora,40000);
}
function eligecelda()
{
		//if((this.parentElement.rowIndex==0)||(this.cellIndex==0))
		if(this.cellIndex==0)
		{
			editor(this);
		}
		else
		{
			bandera="no";
			$("#ventana").fadeIn(500);		//$("#ventana").css("display","block");
			$("#fondo").fadeTo(500, 0.5).css('display', 'block');
			
			$("#ventana").draggable();
			
			ahora=this;
			//$(celdax).removeClass("borde");
			$(celdax).css("border","");
			//celdax.className="";
			planta=ahora.parentElement.cells[0].innerHTML;
			aux=planta.split("<br>");
			planta=aux.join("\r\n");
			fil=ahora.parentElement.rowIndex;
			col=this.cellIndex;
			$(ahora).css("border","5px solid #0099FF");
			celdax=ahora;
			
			//columna=document.getElementById("tb1").rows[0].cells[col].innerHTML;
			var colx=col+1;
			var parte1=$("#tb1 tr:first-child td:nth-child("+colx+") .columna_nivel1").text();
			var parte2=$("#tb1 tr:first-child td:nth-child("+colx+") .columna_nivel2").text();
			aux=parte1.split("<br>");
			parte1=aux.join("\r\n");
			aux=parte2.split("<br>");
			parte2=aux.join("\r\n");
			if(ahora.innerHTML=="")
			{
				$("#contenedor").load("nuevo_inmueble.php",function(e){
				document.getElementById("plantax").value=planta;
				document.getElementById("columnax").value=parte1+"\r\n-----\r\n"+parte2;
				document.getElementById("posfila").value=fil;
				document.getElementById("poscol").value=col;
				$("#proyx").val($("#proyz").val());

				$("#fechaini").datepicker({dateFormat:'dd-mm-yy'});
				$("#fechafin").datepicker({dateFormat:'dd-mm-yy'});
				
				///////para validar/////
				$(".validar").on('change invalid', function() {
			    var valor = $(this).get(0);
			    valor.setCustomValidity('');
			    if (!valor.validity.valid) {
			      valor.setCustomValidity('THINK | Campo Requerido');  
			    }
				});
				/////////////////////////

				});
			}
			else
			{
				//id_inm=document.getElementById("id_inm_"+fil+"_"+col).value;
				id_inm=$(this).find(":input").val();
				$.ajax({
					url: "ver_inmueble.php",
					data: {id:id_inm},
					type: "POST",
					success:function(resultado){
						$("#contenedor").html("");
						$("#contenedor").append(resultado);
						document.getElementById("plantax").value=planta;
						document.getElementById("columnax").value=parte1+"\r\n-----\r\n"+parte2;
						document.getElementById("posfila").value=fil;
						document.getElementById("poscol").value=col;
						$("#proyx").val($("#proyz").val());
						//$(ahora).addClass("borde");
						//celdax=ahora;
						$("#fechaini").datepicker({dateFormat:"dd/mm/yy"});
						$("#fechafin").datepicker({dateFormat:"dd/mm/yy"});
					}
				})
			}
		}
}
function envia()
{
	document.getElementById("form1").submit();
}
function celda(unacelda)
{
	planta=unacelda.parentElement.cells[0].innerHTML;
	col=unacelda.cellIndex;
	columna=document.getElementById("tb1").rows[0].cells[col].innerHTML;
	document.getElementById("plantax").value=planta;
	document.getElementById("columnax").value=columna;
}
function masfila()
{
	proy=$("#proyecto").val();
	ultimo=parseInt(document.getElementById("tb1").rows[1].cells[0].innerHTML);
	$.ajax({
		url:"aumenta_fila.php",
		data:{id_proy:proy,ultimo:ultimo},
		type:"POST",
		success: function(resultado){
			ultimo=parseInt(document.getElementById("tb1").rows[1].cells[0].innerHTML);
			fila=document.getElementById("tb1").insertRow(1);
			nrofilas=document.getElementById("tb1").rows.length;
			nrocol=document.getElementById("tb1").rows[0].cells.length;
			for(k=0;k<nrocol;k++)
			{
				cel=fila.insertCell(k);
				$(cel).click(eligecelda);
				$(cel).on("dragenter dragover drop", function (event) {	
		  			recibe_inm_arrastrado(event,this);
		  		})		
			}
			document.getElementById("tb1").rows[1].cells[0].innerHTML=ultimo + 1;
		}
	})
}
function mascolumna()
{
	proy=$("#proyecto").val();
	$.ajax({
		url:"aumenta_col.php",
		data:{id_proy:proy},
		type:"POST",
		success: function(resultado){
			nrocol=document.getElementById("tb1").rows[0].cells.length;
			nrofilas=document.getElementById("tb1").rows.length;
			for(k=0;k<nrofilas;k++)
			{
				document.getElementById("tb1").rows[k].insertCell(nrocol);
				cel=document.getElementById("tb1").rows[k].cells[nrocol];
				$(cel).click(eligecelda);
				$(cel).on("dragenter dragover drop", function (event) {	
		  			recibe_inm_arrastrado(event,this);
		  		})
				if(k==0) cel.innerHTML="[SinNombre]";
			}
		}
	})
}
function borrafila()
{
	proy=$("#proyecto").val();
	nrofilas=document.getElementById("tb1").rows.length;
	borrarfila=document.getElementById("borrafila").value;
	aux=0;
	for(k=1;k<nrofilas;k++)
	{
		actualfila=document.getElementById("tb1").rows[k].cells[0].innerHTML;
		if(actualfila==borrarfila)
		{
			aux=k;
		}
	}
	if(aux==0)
		alert("Fila no encontrada");
	else
		if(confirm("Está seguro de ELIMINAR la fila " + borrarfila + " con TODO SU CONTENIDO?"))
		{
			$.ajax({
				url: "borra_fila.php",
				data:{id_proy:proy,borrar:borrarfila,pos:aux},
				type:"POST",
				success: function(resultado){
					document.getElementById("tb1").deleteRow(aux);
				}
			})
		}
			
}
function borracol()
{
	proy=$("#proyecto").val();
	nrofilas=document.getElementById("tb1").rows.length;
	nrocol=document.getElementById("tb1").rows[0].cells.length;
	borrarcol=document.getElementById("borracol").value;
	aux=0;
	for(k=1;k<nrocol;k++)
	{
		actualcol=document.getElementById("tb1").rows[0].cells[k].innerHTML;
		if(actualcol==borrarcol)
		{
			aux=k;
		}
	}
	if(aux==0)
		alert("Columna no encontrada");
	else
		if(confirm("Está seguro de ELIMINAR la columna " + borrarcol + " con TODO SU CONTENIDO?"))
		{
			$.ajax({
				url:"borra_col.php",
				data:{id_proy:proy,borrar:borrarcol,pos:aux},
				type:"POST",
				success: function(resultado){
					for(i=0;i<nrofilas;i++)
					{
						document.getElementById("tb1").rows[i].deleteCell(aux);
					}
				}
			})
		}
			
}
function editor(celda)
{
	//alert(celda.cellIndex);
	if(celda.parentElement.rowIndex!=0){
	proy=$("#proyecto").val();
	$(celda).unbind();

		contenido=celda.innerHTML;
		var aux=contenido.split("<br>");
		contenido=aux.join("\r\n");
		celda.innerHTML="<textarea name='editor' id='editor'>"+contenido+"</textarea>";
		casilla=document.getElementById("editor");
		casilla.focus();
		$(casilla).blur(function(sale){
			valor=casilla.value;
			celda.innerHTML=valor.replace(/\r?\n/g, '<br />');
			$(celda).click(eligecelda);

			nrofilas=$("#tb1 tr").length;
			nrocols=document.getElementById("tb1").rows[0].cells.length;
			vectorfilas=new Array();
			for(i=1;i<nrofilas;i++)
			{
				vectorfilas.push(document.getElementById("tb1").rows[i].cells[0].innerHTML);
			}
			cadenafilas=vectorfilas.join(":");
			$.ajax({
				url:"actualiza_nombres_fila_col.php",
				data:{id_proy:proy,cadenafilas:cadenafilas},
				type:"POST",
				success: function(resultado){
					
					
				}
			})
		});
	}
}
function editacolor()
{
	$("#nuevo").css("display","block");
	estado=this.parentElement.cells[1].innerHTML;
	coloractual=this.parentElement.cells[3].bgColor;
	$("#nuevo h1").html(estado);
	$("#nombreestado").val(estado);
	$("#nuevo").css("background-color",coloractual);
	$("#nuevocolor").val(coloractual);

}
function edita_campo(){
	celda=this;
	var valor=$(this).html();
	var id=$(this).parent().find(".id_reg").val();
	var colu=$(this).index();
	var tablas=$(this).parent().find(".tabla_bd").val().split(":");
	var tabla_bd=tablas[0];
	var tabla_selector=tablas[1];	var paraeditar='<input type="text" name="casilla_edit" id="casilla_edit" value="'+valor+'" class=" clase_casilla_edit">';
	$(this).empty();
	$(this).append(paraeditar);
	$(".clase_casilla_edit").focus();
	$(".clase_casilla_edit").dblclick(function (e){
		e.stopImmediatePropagation();
	})
	$(".clase_casilla_edit").blur(function(e){
		$(".clase_casilla_edit").addClass("blink");
		var nuevovalor=$(".clase_casilla_edit").val();
		$.ajax({
			url:"actualiza_campo.php",
			data:{id:id,colu:colu,nuevovalor:nuevovalor,tabla_bd:tabla_bd},
			type:"POST",
			success:function(resultado){
				$(celda).empty();
				$(celda).append(resultado);
			}
		})
	})
}
function edita_selector(){
	celda=this;
	var valor=$(this).html();
	var id=$(this).parent().find(".id_reg").val();
	var colu=$(this).index();
	var tablas=$(this).parent().find(".tabla_bd").val().split(":");
	var tabla_bd=tablas[0];
	var tabla_selector=tablas[1];
	//var tabla_bd=$(this).parent().find(".tabla_bd").val();
	$.ajax({
		url:"llena_selector.php",
		data:{tabla_selector:tabla_selector,valor:valor},
		type:"POST",
		success:function(resultado){
			$(celda).empty();
			$(celda).append(resultado);
			$(".selectorx").change(function(e){
				$(".selectorx").addClass("blink");
				var nuevovalor=$(".selectorx").val();
				var nuevotexto=$(".selectorx option:selected").text();
				//alert(nuevovalor+"--"+nuevotexto);
				$.ajax({
					url:"actualiza_campo_select.php",
					data:{id:id,colu:colu,nuevovalor:nuevovalor,tabla_bd:tabla_bd,nuevotexto:nuevotexto},
					type:"POST",
					success:function(resultado){
						$(celda).empty();
						$(celda).append(resultado);
					}
				})
			})
		}
	})

	var paraeditar='<input type="text" name="casilla_edit" id="casilla_edit" value="'+valor+'" class=" clase_casilla_edit">';
	$(this).empty();
	$(this).append(paraeditar);
	$(".clase_casilla_edit").focus();
	$(".clase_casilla_edit").dblclick(function (e){
		e.stopImmediatePropagation();
	})
	$(".clase_casilla_edit").blur(function(e){
		$(".clase_casilla_edit").addClass("blink");
		var nuevovalor=$(".clase_casilla_edit").val();
		$.ajax({
			url:"actualiza_campo.php",
			data:{id:id,colu:colu,nuevovalor:nuevovalor,tabla_bd:tabla_bd},
			type:"POST",
			success:function(resultado){
				$(celda).empty();
				$(celda).append(resultado);
			}
		})
	})
}
function config(destino,op)
{
	bandera="no";
	$("#ventana_config").fadeIn(500);		//$("#ventana").css("display","block");
	$("#fondo").fadeTo(500, 0.5).css('display', 'block');
	$("#ventana_config").draggable("enable");
	// if($("#contenedor_config").has(".contenedor_mapa").length>0){
	// 	$("#ventana_config").draggable("enable");
	// }
	$("#contenedor_config").empty();
	//$("#ventana_config").draggable();
	var proy=$("#proyecto").val();
	$.ajax({
		url:destino,
		data:{proy:proy},
		type:"POST",
		success: function(resultado){
			$("#contenedor_config").append(resultado);
			$(".texto").dblclick(edita_campo);
			$(".selector").dblclick(edita_selector);
			$(".esquema_colores").click(muestra_grilla_colores);
			///////para validar/////
			$(".validar").on('change invalid', function() {
		    var valor = $(this).get(0);
		    valor.setCustomValidity('');
		    if (!valor.validity.valid) {
		      valor.setCustomValidity('THINK | Campo Requerido');  
		    }
			});
			/////////////////////////			
			$(".boton_guardar").click(function(e){
			})
			switch (op){
				case "1":
					$(".op_elim").click(elimina_proy);
					break;
				case "2":
					$(".op_elim2").click(elimina_estado_proy);
					break;
				case "3":
					$(".op_elim3").click(elimina_areacomun);
					break;
				case "4":
					$(".op_elim4").click(elimina_tipo_inm);
					break;
				case "5":
					$("#nuevocolor").css("color","red");
					$(".celdacolor").dblclick(editacolor);
					$(".op_elim5").click(elimina_estado_inm);
					break;
				case "6":
					$(".op_elim6").click(elimina_ambiente_propio);
					break;
				case "7":
					$(".op_elim7").click(elimina_usuario);
					break;
				case "8":
					$(".op_elim8").click(elimina_tipo_usuario);
					break;			
				case "9":
					$(".op_elim9").click(elimina_cliente);
					break;
			}
		}
	})
}
function elimina_cliente(e){
	var id=$(this).find(":input").val();
	var nombre=$(this).parent().parent().find("td:eq(1)").html();
	if(confirm("Está seguro de ELIMINAR el Cliente: "+nombre+"?\nLos inmuebles relacionados con este Cliente tendrán este campo vacío"))
	{
		if(confirm(">>>XXX ESTÁ SEGURO DE ELIMINAR EL CLIENTE: " + nombre+"???<<<XXX\n\nLos registros con este campo\n\ntendrán vacío en el lugar de este campo\n\n\n\nSI NO ESTÁ SEGURO APRETE CANCELAR\n\n\n\n\n"))
		{
			$.ajax({
				url:"elimina_cliente.php",
				data:{id:id},
				type:"POST",
				success:function(resultado){
					window.location="inmuebles.php";
				}
			})
		}
	}
}
function elimina_tipo_usuario(e){
	var id=$(this).find(":input").val();
	var nombre=$(this).parent().parent().find("td:eq(1)").html();
	if(confirm("Está seguro de ELIMINAR el Tipo de Usuario: "+nombre+"?\nLos usuarios relacionados con este Tipo tendrán este campo vacío"))
	{
		if(confirm(">>>XXX ESTÁ SEGURO DE ELIMINAR EL TIPO DE USUARIO: " + nombre+"???<<<XXX\n\nLos registros con este campo\n\ntendrán vacío en el lugar de este campo\n\n\n\nSI NO ESTÁ SEGURO APRETE CANCELAR\n\n\n\n\n"))
		{
			$.ajax({
				url:"elimina_tipo_usuario.php",
				data:{id:id},
				type:"POST",
				success:function(resultado){
					window.location="inmuebles.php";
				}
			})
		}
	}
}
function elimina_usuario(e){
	var id=$(this).find(":input").val();
	var nombre=$(this).parent().parent().find("td:eq(1)").html();
	if(confirm("Está seguro de ELIMINAR el Usuario: "+nombre+"?\nLos Inmuebles relacionados con este usuario tendrán este campo vacío"))
	{
		if(confirm(">>>XXX ESTÁ SEGURO DE ELIMINAR EL USUARIO: " + nombre+"???<<<XXX\n\nLos registros con este campo\n\ntendrán vacío en el lugar de este campo\n\n\n\nSI NO ESTÁ SEGURO APRETE CANCELAR\n\n\n\n\n"))
		{
			$.ajax({
				url:"elimina_usuario.php",
				data:{id:id},
				type:"POST",
				success:function(resultado){
					window.location="inmuebles.php";
				}
			})
		}
	}
}
function elimina_ambiente_propio(e){
	var id=$(this).find(":input").val();
	var nombre=$(this).parent().parent().find("td:eq(1)").html();
	if(confirm("Está seguro de ELIMINAR el Ambiente Propio: "+nombre+"?\nLos Inmuebles con este Ambiente Propio tendrán este Ambiente Propio vacío"))
	{
		if(confirm(">>>XXX ESTÁ SEGURO DE ELIMINAR EL AMBIENTE: " + nombre+"???<<<XXX\n\nLos registros con este campo\n\ntendrán vacío en el lugar de este campo\n\n\n\nSI NO ESTÁ SEGURO APRETE CANCELAR\n\n\n\n\n"))
		{
			$.ajax({
				url:"elimina_ambiente_propio.php",
				data:{id:id},
				type:"POST",
				success:function(resultado){
					window.location="inmuebles.php";
				}
			})
		}
	}
}
function elimina_estado_inm(e){
	var id=$(this).find(":input").val();
	var nombre=$(this).parent().parent().find("td:eq(1)").html();
	if(confirm("Está seguro de ELIMINAR el Estado: "+nombre+"?\nLos Inmuebles con este Estado tendrán el campo Estado de inmueble vacío"))
	{
		if(confirm(">>>XXX ESTÁ SEGURO DE ELIMINAR EL ESTADO: " + nombre+"???<<<XXX\n\nLos registros con este campo\n\ntendrán vacío en el lugar de este campo\n\n\n\nSI NO ESTÁ SEGURO APRETE CANCELAR\n\n\n\n\n"))
		{
			$.ajax({
				url:"elimina_estado_inm.php",
				data:{id:id},
				type:"POST",
				success:function(resultado){
					//alert(resultado);
					window.location="inmuebles.php";
				}
			})
		}
	}
}
function elimina_tipo_inm(e){
	var id=$(this).find(":input").val();
	var nombre=$(this).parent().parent().find("td:eq(1)").html();
	if(confirm("Está seguro de ELIMINAR el Tipo: "+nombre+"?\nLos Inmuebles con este Tipo tendrán el campo Tipo de inmueble vacío"))
	{
		if(confirm(">>>XXX ESTÁ SEGURO DE ELIMINAR EL TIPO: " + nombre+"???<<<XXX\n\nLos registros con este campo\n\ntendrán vacío en el lugar de este campo\n\n\n\nSI NO ESTÁ SEGURO APRETE CANCELAR\n\n\n\n\n"))
		{
			$.ajax({
				url:"elimina_tipo_inm.php",
				data:{id:id},
				type:"POST",
				success:function(resultado){
					window.location="inmuebles.php";
				}
			})
		}
	}
}
function elimina_estado_proy(e){
	var id=$(this).find(":input").val();
	var nombre=$(this).parent().parent().find("td:eq(1)").html();
	if(confirm("Está seguro de ELIMINAR el estado: "+nombre+"?\nLos Proyectos con este estado tendrán el campo estado vacío"))
	{
		if(confirm(">>>XXX ESTÁ SEGURO DE ELIMINAR EL ESTADO: " + nombre+"???<<<XXX\n\nLos registros con este campo\n\ntendrán vacío en el lugar de este campo\n\n\n\nSI NO ESTÁ SEGURO APRETE CANCELAR\n\n\n\n\n"))
		{
			$.ajax({
				url:"elimina_estado_proy.php",
				data:{id:id},
				type:"POST",
				success:function(resultado){
					//alert(resultado);
					window.location="inmuebles.php";
				}
			})
		}
	}
}
function elimina_areacomun(e){
	var id=$(this).find(":input").val();
	var nombre=$(this).parent().parent().find("td:eq(1)").html();
	if(confirm("Está seguro de ELIMINAR el area común: "+nombre+"?\nLos Proyectos con este campo tendrán dejarán de tenerlo"))
	{
		if(confirm(">>>XXX ESTÁ SEGURO DE ELIMINAR EL AREA COMÚN: " + nombre+"???<<<XXX\n\nLos registros relacionados con este campo\n\nya no tendrán este campo\n\n\n\nSI NO ESTÁ SEGURO APRETE CANCELAR\n\n\n\n\n"))
		{
			$.ajax({
				url:"elimina_areacomun.php",
				data:{id:id},
				type:"POST",
				success:function(resultado){
					window.location="inmuebles.php";
				}
			})
		}
	}
}
function salir(){
	if(confirm("Está seguro de Salir del Sistema?")){
		$.ajax({
			url:"salir.php",
			success:function(resultado){
				window.location=".";
			}
		})
	}
}
function muestra_menu_contextual(event,inmueble){
	event.stopPropagation();
	inmueble_contextual=inmueble;
	id_inm_contextual=$(inmueble).find(":input").val();
	var x=event.pageX + "px";
	var y=event.pageY + "px";
	$(".menu_contextual").css("display","block");
	$(".menu_contextual").css("left",x);
	$(".menu_contextual").css("top",y);
	return false;
}
function oculta_menu_contextual(){
	$(".menu_contextual").css("display","none");
}
function propaga_precio(){
	var col=$(this).parent().index();
	var col_child=col+1;
	var valor=$(this).parent().find(":input").val();
	//alert(valor);
	var nro_filas=$(".clase_tabla_columnas tr").length;
	for(k=2;k<=nro_filas;k++){
		$(".clase_tabla_columnas tr:nth-child("+k+") td:nth-child("+col_child+")").find(":input").val(valor);
	}
}
function propaga_adicion(){
	//alert("hola");
	var col=$(this).parent().index();
	var col_child=col+1;
	var valor=parseInt($(this).parent().find(":input").val());
	//alert(valor);
	var nro_filas=$(".clase_tabla_columnas tr").length;
	for(k=2;k<=nro_filas;k++){
		var antiguo_valor=$(".clase_tabla_columnas tr:nth-child("+k+") td:nth-child("+col_child+")").find(".antiguo_valor").text();
			antiguo_valor=parseInt(antiguo_valor);
		if($.isNumeric(antiguo_valor)){	
			var nuevo_valor=antiguo_valor+valor;
			$(".clase_tabla_columnas tr:nth-child("+k+") td:nth-child("+col_child+")").find(":input").val(nuevo_valor);
		}
	}
}
function propaga_porcentaje(){
	var col=$(this).parent().index();
	var col_child=col+1;
	var valor=parseInt($(this).parent().find(":input").val());
	//alert(valor);
	var nro_filas=$(".clase_tabla_columnas tr").length;
	for(k=2;k<=nro_filas;k++){
		var antiguo_valor=$(".clase_tabla_columnas tr:nth-child("+k+") td:nth-child("+col_child+")").find(".antiguo_valor").text();
			antiguo_valor=parseInt(antiguo_valor);
		if($.isNumeric(antiguo_valor)){	
			var nuevo_valor=antiguo_valor + (valor/100)*antiguo_valor;
			$(".clase_tabla_columnas tr:nth-child("+k+") td:nth-child("+col_child+")").find(":input").val(nuevo_valor);
		}
	}
}