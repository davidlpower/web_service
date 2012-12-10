<!--
You are free to copy and use this sample in accordance with the terms of the
Apache license (http://www.apache.org/licenses/LICENSE-2.0.html)
-->

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="content-type" content="text/html; charset=utf-8" />
        <title>Room Occupancy Temperature</title>
        <script type="text/javascript" src="http://www.google.com/jsapi"></script>
        <script type="text/javascript">
            google.load('visualization', '1', {packages: ['annotatedtimeline']});
            function drawVisualization() {
                var data = new google.visualization.DataTable();
                data.addColumn('datetime', 'Date');
                data.addColumn('number', 'Temperture');
                data.addColumn('number', 'Humidity');
                data.addRows([
                    [new Date(2012, 1 ,1 ,12 ,31 ,10), 10, 30],
                    [new Date(2012, 1 ,1 ,12 ,32 ,15), 20, 25],
                    [new Date(2012, 1 ,1 ,12 ,33 ,55), 30, 21],
                    [new Date(2012, 1 ,1 ,12 ,34 ,05), 10, 22],
                    [new Date(2012, 1 ,1 ,12 ,34 ,55), 07, 33],
                    [new Date(2012, 1 ,1 ,12 ,35 ,42), 08, 33],
                    [new Date(2012, 1 ,1 ,12 ,36 ,15), 09, 30],
                    [new Date(2012, 1 ,1 ,12 ,37 ,00), 10, 29],
                ]);
    
                var annotatedtimeline = new google.visualization.AnnotatedTimeLine(
                document.getElementById('visualization'));
                annotatedtimeline.draw(data, {'displayAnnotations': true});
            }
    
            google.setOnLoadCallback(drawVisualization);
        </script>
    </head>    
    <body style="font-family: Arial;border: 0 none;">
        <div id="container" style="width: 850px; margin: 0 auto;">
            <div id="table_title"><h1>Sitting Room - Daily Breakdown</h1></div>
            <div id="home"><a href="/graph"><i>back to list</i></a></div>
            <div id="visualization" style="width: 800px; height: 400px;"></div>
        </div>
    </body>

</html>
