<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8"/>
    <title>
        Current Sitting Room Data
    </title>
    <script type="text/javascript" src="http://www.google.com/jsapi"></script>
    <script type="text/javascript">
      google.load('visualization', '1', {packages: ['corechart']});
    </script>
    <script type="text/javascript">
      function drawVisualization() {
        // Create and populate the data table.
        var data = google.visualization.arrayToDataTable([
          ['Date-Time', 'Current Temperature', 'Average Temperature'],
          ['10-20-2012 12:30',  17.30,    18.20]
        ]);
      
        // Create and draw the visualization.
        new google.visualization.BarChart(document.getElementById('visualization')).
            draw(data,
                 {title:"Sitting Room Environmental Data", 
                  width:320, height:240, vAxis: {title: "Date"}, hAxis: {title: "Data"}}
            );
      }
      

      google.setOnLoadCallback(drawVisualization);
    </script>
  </head>
  <body style="font-family: Arial;border: 0 none;">
      <div id="table_data"><?= @$graph_data?></div>
    <div id="visualization" style="width: 600px; height: 400px;"></div>
  </body>
</html>