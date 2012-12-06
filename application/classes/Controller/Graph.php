<?php

defined('SYSPATH') or die('No direct script access.');

class Controller_Graph extends Controller {

    public function action_index() {

        $head = "<title>Arduino Temperature Logger</title>";

        // Get data from database
        $service = new Model_Webmodel();
        $result = $service->getPercentageDifference();
        $temp = $service->getBreakdown();

        if ($result == 'TRUE')
        {
            $background = 'style="background: #EE6363;"';
        }
        elseif ($result == 'FALSE')
        {
            $background = 'style="background: #66CCCC;"';
        }
        else
        {
            $background = 'style="background: #FFFFF1;"';
        }

        $view = View::factory('graph')
                ->set('head', $head)
                ->set('background', $background)
                ->set('barchart', $this->get_barchart($temp));


        echo $view->render();
    }

    public function get_barchart($data) {
        $view = View::factory('graph')
                ->set('data', $data);
        echo $view->render();
    }

    public function action_currentdata() {
        $db_model = new Model_Webmodel();
        $data = $db_model->getDailyAverage();
        $view = View::factory('currentdata')
                ->set('graph_data', $data);
        echo $view->render();
    }

}