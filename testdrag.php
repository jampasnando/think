<!DOCTYPE html>
<html>
<head>
	<title></title>
  <link rel="stylesheet" href="jquery-ui.min.css">
	<script src="jquery-3.3.1.min.js"></script>
	<!--<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>-->
    <script src="jquery-ui.min.js"></script>
    <script src="script/jquery.ui.touch-punch.min.js"></script>
<script>
	$(".celda").draggable();
	$(".contenedor").droppable();
</script>
<style type="text/css">
.contenedor{
	height: 400px;
	width: 600px;
	background-color: gray;
}
.celda{
	height:50px;
	width: 50px;
	border: 1px solid black;
}
</style>
</head>
<body>
<div class="contenedor">
	<div class="celda" draggable="true">
		
	</div>
</div>
</body>
</html>