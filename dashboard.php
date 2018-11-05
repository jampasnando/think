<html>
  <head>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script src="jquery-3.3.1.min.js"></script>
    <script type="text/javascript">
    google.charts.load('current', {'packages':['corechart']});
    google.charts.setOnLoadCallback(drawChart);
    function drawChart() {
      $.ajax({
        url:"datos.php",
        success:function(jsonData){
          var data = new google.visualization.DataTable(jsonData);
          var chart = new google.visualization.ColumnChart(document.getElementById('chart_div'));
          chart.draw(data, {width: 600, height: 500});
          chart.draw(data,{"title":"Grafica Proyectos"});
        }
      })  
    }

    </script>
  </head>

  <body>
    <div id="chart_div"></div>
  </body>
</html>