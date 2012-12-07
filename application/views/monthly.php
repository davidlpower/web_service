<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="content-type" content="text/html; charset=utf-8"/>
        <title>
            Monthly Breakdown
        </title>
        <script type="text/javascript" src="http://www.google.com/jsapi"></script>
        <script type="text/javascript">
            google.load('visualization', '1', {packages: ['corechart']});
        </script>
        <script type="text/javascript">
            function drawVisualization() {
                // Create and populate the data table.
                var data = google.visualization.arrayToDataTable([
                    ['Date-Time', 'Lowest Temperature', 'Higest Temperature'],
                    <?php 
                    foreach($graph_data as $key => $day){
                        if($key < sizeof($graph_data)-1){
                          echo '["'.$day['date'].'",'.$day['Lowest_Temp'].','.$day['Higest_Temp'].'],';  
                        }else{
                           echo '["'.$day['date'].'",'.$day['Lowest_Temp'].','.$day['Higest_Temp'].']';   
                        }
                        
                    }
                    ?>
                ]);
      
                // Create and draw the visualization.
                new google.visualization.BarChart(document.getElementById('visualization')).
                    draw(data,
                {title:"Sitting Room Environmental Data", 
                    width:860, height:700, vAxis: {title: "Date"}, hAxis: {title: "Temperature"}}
            );
            }
      
            google.setOnLoadCallback(drawVisualization);
        </script>
    </head>
    <body style="font-family: Arial;border: 0 none;">
        <div id="container" style="width: 900px; margin: 0 auto;">
            <div id="table_title"><h1>Sitting Room - Monthly Breakdown</h1></div>
            <div id="visualization" style="width: 860px; height: 700px;"></div>
        </div>
    </body>
</html>