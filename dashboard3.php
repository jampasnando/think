<html>
  <head>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script src="jquery-3.3.1.min.js"></script>
    <script type="text/javascript">
    google.charts.load('current'); 
      // Don't need to specify chart libraries!
    google.charts.setOnLoadCallback(drawChart);
    
    function drawChart() {
      
      var wrapper = new google.visualization.ChartWrapper({
          chartType: 'BarChart',
          //dataTable: "datos2.php",
          //dataTable: [['', 'Germany', 'USA', 'Brazil', 'Canada', 'France', 'RU'],
                     //['', 700, 300, 400, 500, 600, 800]],
          options: {'title': 'Número de inmuebles por tipo',height:400},
          containerId: 'chart_div'
        });
        $.ajax({
          url:"datos2.php",
          success:function(jsonData){
            var data = new google.visualization.DataTable(jsonData);
            //var chart = new google.visualization.BarChart(document.getElementById('chart_div'));
            wrapper.setDataTable(data);
            //wrapper.draw(data,{isStacked:true});

          }
        })  
        wrapper.setOption("vAxis.title","Proyectos");
        wrapper.setOption("isStacked",true);
        wrapper.draw();
    }


    </script>
  </head>

  <body>
    <div id="chart_div"></div>
  </body>
</html>