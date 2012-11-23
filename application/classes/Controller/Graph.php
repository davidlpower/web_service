<?php

include 'vendor/phpgraphlib_v2/phpgraphlib.php';

defined('SYSPATH') or die('No direct script access.');

class Controller_Graph extends Controller {

    public function action_index() {

        $head = "<title>Arduino Temperature Logger</title>";

        // Get data from database
        $service = new Model_Webmodel();
        $result = $service->getPercentageDifference();

        if ($result == 'TRUE')
        {
            $background = 'style="background: #EE6363;"';
        }
        else
        {
            $background = 'style="background: 66CCCC;"';
        }

        $view = View::factory('graph')
                ->set('head', $head)
                ->set('background', $background)
                ->bind('barchart',$this->action_barchart());
        

        echo $view->render();
    }

    public function action_barchart() {
        $this->auto_render = FALSE;
        $graph = new PHPGraphLib(400, 300);
        $data = array("Alex" => 99, "Mary" => 98, "Joan" => 70, "Ed" => 90);
        $graph->addData($data);
        $graph->setTitle("Test Scores");
        $graph->setTextColor("blue");
        $graph->createGraph();
    }

}