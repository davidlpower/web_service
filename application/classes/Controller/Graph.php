<?php

defined('SYSPATH') or die('No direct script access.');

class Controller_Graph extends Controller {

    public function action_index() {

        $view = View::factory('graph');
        echo $view->render();
    }

    public function get_barchart($data) {
        $view = View::factory('graph')
                ->set('data', $data);
        echo $view->render();
    }

    public function action_currentdata() {
        $db_model = new Model_Webmodel();
        $data = $db_model->getBreakdown();

        $view = View::factory('currentdata')
                ->set('graph_data', $data);
        
        echo $view->render();
    }

}