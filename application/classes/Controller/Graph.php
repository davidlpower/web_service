<?php

defined('SYSPATH') or die('No direct script access.');

class Controller_Graph extends Controller {

    public function action_index() {


        $head = "<title>Arduino Temperature Logger</title>
    <script type=\"text/javascript\" src=\"http://www.google.com/jsapi\"></script>
    <script type=\"text/javascript\">
      google.load('visualization', '1');
    </script>
    <script type=\"text/javascript\">
      function drawVisualization() {
        var wrapper = new google.visualization.ChartWrapper({
          chartType: 'ColumnChart',
          dataTable: [['', 'Germany', 'USA', 'Brazil', 'Canada', 'France', 'RU'],
                      ['', 700, 300, 400, 500, 600, 800]],
          options: {'title': 'Hourly Temperature'},
          containerId: 'visualization'
        });
        wrapper.draw();
      }
      google.setOnLoadCallback(drawVisualization);
    </script>";

        $body = '<div id="visualization" style="width: 600px; height: 400px;"></div>';

        // Get data from database
        $service = new Model_Webmodel();
        $result = $service->getDevice($device);

     
        
        $this->response->body("<html><head>" . $head . "</head><body>" . $body . "</body></html>");
    }
}
?>