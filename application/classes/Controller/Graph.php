<?php

defined('SYSPATH') or die('No direct script access.');

class Controller_Graph extends Controller {

    public function action_index() {

        $view = View::factory('graphs');
        echo $view->render();
    }   

    // Daily
    public function action_daily() {
        $db_model = new Model_Webmodel();
        $data = $db_model->getDailyBreakdown();

        $view = View::factory('daily')
                ->set('graph_data', $data);
        
        echo $view->render();
    }

    // All Records
    public function action_record() {
        $db_model = new Model_Webmodel();
        $data = $db_model->getRecord();
        
        // Set a holder for the row data
        $row_data = null;
        echo '<pre>';
        foreach($data as $key => $value){
           $date_time = explode(' ', $value['date']);
           print_r($date_timep);
        }
        
        
        // echo '<pre>';
        // print_r($data);
        echo '</pre>';
        die;
        
        $view = View::factory('record')
                ->set('records', $data);
        
        echo $view->render();
    }

    
    // Weekly
    public function action_weekly() {
        $db_model = new Model_Webmodel();
        $data = $db_model->getWeeklyBreakdown();

        $view = View::factory('weekly')
                ->set('graph_data', $data);
        
        echo $view->render();
    }
    
    // Monthly
    public function action_monthly() {
        $db_model = new Model_Webmodel();
        $data = $db_model->getMonthlyBreakdown();

        $view = View::factory('monthly')
                ->set('graph_data', $data);
        
        echo $view->render();
    }
}