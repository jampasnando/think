// JavaScript Document
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
		//$(".div_inm").draggable();
/////////////////////////////////////////////////////////////////////////////////
		$(".boton_barra").click(aparece);
		//$('.div_inm').draggable();
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
		//$("#ventana").css("display","none");
		$("#ventana").fadeOut(500);
		$("#fondo").fadeOut(500);
		$(celdax).css("border","");
		bandera="si";
	});
	$("#cerrar_config").click(function(e2){
		$("#contenedor_config").empty();
		$("#ventana_config").fadeOut(500);
		$("#fondo").fadeOut(500);
		bandera="si";
	});
// 

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
			$(inmueble_contextual).find(".acronimo_estado_inm").text(texto);
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
	var id_inm=$(this).find(":input").val();
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
	$(".acronimo_estado_inm").each(function(index, element) {
        dentro=element.innerHTML;
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
		if((this.parentElement.rowIndex==0)||(this.cellIndex==0))
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
			
			columna=document.getElementById("tb1").rows[0].cells[col].innerHTML;
			aux=columna.split("<br>");
			columna=aux.join("\r\n");
			if(ahora.innerHTML=="")
			{
				$("#contenedor").load("nuevo_inmueble.php",function(e){
				document.getElementById("plantax").value=planta;
				document.getElementById("columnax").value=columna;
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
						document.getElementById("columnax").value=columna;
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
			vectorcols=new Array();
			for(k=1;k<nrocols;k++)
			{
				vectorcols.push(document.getElementById("tb1").rows[0].cells[k].innerHTML);
			}
			cadenacols=vectorcols.join(":");

			$.ajax({
				url:"actualiza_nombres_fila_col.php",
				data:{id_proy:proy,cadenafilas:cadenafilas,cadenacols:cadenacols},
				type:"POST",
				success: function(resultado){
					
					
				}
			})
		});

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
	//.stopImmediatePropagation();
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
	$("#ventana_config").draggable();
	var proy=$("#proyecto").val();
	$.ajax({
		url:destino,
		data:{proy:proy},
		type:"POST",
		success: function(resultado){
			$("#contenedor_config").append(resultado);
			$(".texto").dblclick(edita_campo);
			$(".selector").dblclick(edita_selector);
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