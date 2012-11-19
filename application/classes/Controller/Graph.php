<?php

defined('SYSPATH') or die('No direct script access.');

class Controller_Graph extends Controller {

    public function action_index() {

        $head = "<title>Arduino Temperature Logger</title>
            <title>
      Google Visualization API Sample
    </title>
    <script type=\"text/javascript\" src=\"http://www.google.com/jsapi\"></script>
    <script type=\"text/javascript\">
      google.load('visualization', '1', {packages: ['corechart']});
    </script>
    <script type=\"text/javascript\">
      function drawVisualization() {
        // Create and populate the data table.
        var data = google.visualization.arrayToDataTable([
          ['Year', 'Austria', 'Belgium', 'Czech Republic', 'Finland', 'France', 'Germany'],
          ['2003',  1336060,   3817614,       974066,       1104797,   6651824,  15727003],
          ['2004',  1538156,   3968305,       928875,       1151983,   5940129,  17356071],
          ['2005',  1576579,   4063225,       1063414,      1156441,   5714009,  16716049],
          ['2006',  1600652,   4604684,       940478,       1167979,   6190532,  18542843],
          ['2007',  1968113,   4013653,       1037079,      1207029,   6420270,  19564053],
          ['2008',  1901067,   6792087,       1037327,      1284795,   6240921,  19830493]
        ]);
      
        // Create and draw the visualization.
        new google.visualization.ColumnChart(document.getElementById('visualization')).
            draw(data,
                 {title:\"Hourly Temperature\",
                  width:600, height:400,
                  hAxis: {title: \"Year\"}}
            );
      }
      

      google.setOnLoadCallback(drawVisualization);
    </script>";

​

        $body = '<div id="visualization" style="width: 600px; height: 400px;"></div>';

        // Get data from database
        $service = new Model_Webmodel();
        $result = $service->getDailyAverage();

     
        
        $this->response->body("<html><head>" . $head . "</head><body>" . $body . "</body></html>");
    }
}
?>