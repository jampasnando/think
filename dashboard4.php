<html>
  <head>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script src="jquery-3.3.1.min.js"></script>
    <script type="text/javascript">
    //google.charts.load('current'); 
    google.charts.load('current', {packages: ['charteditor']});
      // Don't need to specify chart libraries!
    google.charts.setOnLoadCallback(drawChart);
    //chartEditor = null;
    function drawChart() {
      
       wrapper = new google.visualization.ChartWrapper({
          chartType: 'BarChart',
          options: {title: 'Número de inmuebles por tipo',height:500,isStacked:true},

          containerId: 'chart_div'
        });
        $.ajax({
          url:"datos2.php",
          success:function(jsonData){
            data = new google.visualization.DataTable(jsonData);
            //alert(data);
            //var chart = new google.visualization.BarChart(document.getElementById('chart_div'));
            wrapper.setDataTable(data);
            wrapper.setOption("vAxis.title","Proyectos");
            //wrapper.draw(data,{isStacked:true});
            wrapper.draw();
            chartEditor = new google.visualization.ChartEditor();
            google.visualization.events.addListener(chartEditor, 'ok', redrawChart);
            
          }
        })  
        
        //chartEditor = new google.visualization.ChartEditor();
        // google.visualization.events.addListener(chartEditor, 'ok', redrawChart);
        // chartEditor.openDialog(wrapper, {});
        
        //
        //wrapper.setOption("isStacked",true);
        
        
    }

    function redrawChart(){
      chartEditor.openDialog(wrapper, {});
      chartEditor.getChartWrapper().draw(document.getElementById('chart_div'));
    }
    function abre(){
      chartEditor.openDialog(wrapper, {});
      chartEditor.getChartWrapper().draw(document.getElementById('chart_div'));
    }
    </script>
  </head>

  <body>
    <input type="button" name="boton" id="boton" value="Editar" onclick="abre();">
    <div id="chart_div"></div>
  </body>
</html>