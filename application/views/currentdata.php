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
                    [<?= @$date; ?>,  <?= @$current; ?>,    <?= @$average; ?>]
                ]);
      
                // Create and draw the visualization.
                new google.visualization.BarChart(document.getElementById('visualization')).
                    draw(data,
                {title:"Sitting Room Environmental Data", 
                    width:640, height:480, vAxis: {title: "Date"}, hAxis: {title: "Data"}}
            );
            }
      
            google.setOnLoadCallback(drawVisualization);
        </script>
    </head>
    <body style="font-family: Arial;border: 0 none;">
        <div id="container" style="width: 900px; margin: 0 auto;">
            <div id="table_title"><h1>Current Sitting Room Data</h1></div>
            <div id="visualization" style="width: 640px; height: 480px;"></div>
        </div>
    </body>
</html>