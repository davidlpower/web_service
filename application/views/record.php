<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="content-type" content="text/html; charset=utf-8" />
        <title>Room Occupancy Temperature</title>
        <script type="text/javascript" src="<?php echo '/assets/jquery-1.8.3.js'; ?>"></script>
        <script type="text/javascript" src="http://www.google.com/jsapi"></script>
        <script type="text/javascript">
            google.load('visualization', '1', {packages: ['annotatedtimeline']});
            function drawVisualization() {
                var data = new google.visualization.DataTable();
                data.addColumn('datetime', 'Date');
                data.addColumn('number', 'Temperture');
                data.addColumn('number', 'Humidity');
                data.addRows([
                <?php 
                echo @$records;
                ?>
                ]);
    
                var annotatedtimeline = new google.visualization.AnnotatedTimeLine(
                document.getElementById('visualization'));
                annotatedtimeline.draw(data, {
                    'displayAnnotations': true,
                    'colors': ['red', 'blue', '#0000bb'],
                    'thickness': 1
                });
            }
    
            google.setOnLoadCallback(drawVisualization);
        </script>
    </head>    
    <body style="font-family: Arial;border: 0 none;">
        <div id="container" style="width: 950px; margin: 0 auto;">
            <div id="table_title"><h1>Room Occupancy - Records</h1></div>
            <div id="home"><a href="/graph"><i>back to list</i></a></div>
            <img id="loading" src="<?php echo '/assets/loading.gif'; ?>">
            <br />
            <div id="visualization" style="width: 850px; height: 450px;"></div>
        </div>
    </body>

</html>

<script>
    // Fade the image out
    $('#loading').fadeOut(2500);
</script>