<!DOCTYPE html>
<html>
<head>
	<title></title>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCwk67TfCngpCbeKFht2VX196hMohgH6Ws&callback=iniciamapa"
    async defer></script>
    <script src="jquery-3.3.1.min.js"></script>
<script type="text/javascript">
	var mapa;
	$(document).ready(inicio);
	function inicio(){
		
		$("#boton").click(marca);
		
	}
	function iniciamapa(){
			mapa=new google.maps.Map(document.getElementById("div_mapa"),{
				center:{lat:-17.3731769,lng:-66.1491599},
				zoom:15
			})
			// var marca=new google.maps.Marker({
			// 	position:{lat:-17.3731769,lng:-66.1491599},
			// 	map:mapa
			// })
			$('<div/>').addClass('pin').appendTo(mapa.getDiv()).click(function(){
	               var that=$(this);
	               if(!that.data('win')){
	                that.data('win',new google.maps.InfoWindow({content:'Arrastrar el mapa para poner este pin en el punto deseado'}));
	                that.data('win').bindTo('position',mapa,'center');
	               }
	               that.data('win').open(mapa);
	            });
			google.maps.event.addListener(mapa,'center_changed', function() {
		  		var latitud = mapa.getCenter().lat();
		  		var longitud = mapa.getCenter().lng();
		  		$("#lat").val(latitud);
		  		$("#lon").val(longitud);
			});
	//////////////
			obtenerxml('proyectosxml.php', function(data) {
			  var xml = data.responseXML;
			  var markers = xml.documentElement.getElementsByTagName('marcador');
			  Array.prototype.forEach.call(markers, function(markerElem) {
				    var id = markerElem.getAttribute('id');
				    var name = markerElem.getAttribute('nombre');
				    var address = markerElem.getAttribute('direccion');
				    //var type = markerElem.getAttribute('type');
				    var point = new google.maps.LatLng(
				        parseFloat(markerElem.getAttribute('latitud')),
				        parseFloat(markerElem.getAttribute('longitud'))
				        );

				    var infowincontent = document.createElement('div');
				    var strong = document.createElement('strong');
				    strong.textContent = name
				    infowincontent.appendChild(strong);
				    infowincontent.appendChild(document.createElement('br'));

				    var text = document.createElement('text');
				    text.textContent = address
				    infowincontent.appendChild(text);
				    //var icon = customLabel[type] || {};
				    var marker = new google.maps.Marker({
				      map: mapa,
				      position: point,
				      //label: icon.label
				   	});
				   	infoWindow = new google.maps.InfoWindow;
				   	marker.addListener('click', function() {
	                infoWindow.setContent(infowincontent);
	                infoWindow.open(mapa, marker);
	              	});
	              	//	infoWindow.open(mapa,marker);
			 	})
			 })

	//////////////		

	}
	function marca(){
			//alert("hola");
			var lat=parseFloat($("#lat").val());
			var lon=parseFloat($("#lon").val());
			var coordenadas = new google.maps.LatLng(lat,lon);
			//alert(lat+"--"+lon);
			var mi_icono="images/icon3.png";
			var nuevamarca=new google.maps.Marker({
				position:coordenadas,
				map:mapa,
				icon:mi_icono,
			})
			var contenido_emergente="hola";
			var emergente=new google.maps.InfoWindow({
				content:contenido_emergente
			})
			nuevamarca.addListener("click",function(){
				emergente.open(mapa,nuevamarca);
			});

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

		 request.open('GET', url, true);
		 request.send(null);
	}
	
	 function nohacernada(){}  	
</script>
<style type="text/css">
	#div_mapa{
		height: 500px;
		width: 500px;
		background-color: yellow;
	}
	#div_mapa .pin{
		position:absolute;
	  	/*url of the marker*/
	  	background:url(http://maps.gstatic.com/mapfiles/markers2/marker.png) no-repeat;
	  	/*center the marker*/
	  	top:50%;left:50%;
	  	z-index:1;
	  	/*fix offset when needed*/
	  	margin-left:-10px;
	  	margin-top:-34px;
	  	/*size of the image*/
	  	height:34px;
	  	width:20px;
	  	cursor:pointer;
	}
</style>
</head>
<body>
<div class="div_mapa" id="div_mapa"></div>
<input type="text" name="lat" id="lat">
<input type="text" name="lon" id="lon">
<input type="button" name="boton" id="boton" value="Marcar">
</body>
</html>