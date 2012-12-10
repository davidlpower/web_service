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

    // Create javascript data rows
    public function create_jsData($data){
        
        // Set a holder for the row data
        $row_data = '';
        $outer_counter = sizeof($data);
        foreach ($data as $key => $value) {

            $row_data .= '[';

            $date_time = explode(' ', $value['date']);
            $date = explode('-', $date_time[0]);
            $time = explode(':', $date_time[1]);
            $row_data .= 'new Date(';

            // save the date values
            foreach ($date as $value_1) {
                $row_data .= $value_1;
                $row_data .= ', ';
            }

            $counter = 3;
            // save the time values
            foreach ($time as $value_2) {
                $row_data .= $value_2;
                if ($counter > 1)
                {
                    $row_data .= ', ';
                }
                $counter--;
            }

            $row_data .= '), ' . $value['temperature'] . ', ' . $value['humidity'] . ']';

            // Not needed at the end
            if($outer_counter > 1) {
                $row_data .= ',';
            }
            $outer_counter--;
        }
        return $row_data;
    }
    
    // All Records
    public function action_record() {
        $db_model = new Model_Webmodel();
        $data = $db_model->getRecord();

        // Create javascript data rows
        $row_data = $this->create_jsData($data);
       
        $view = View::factory('record')
                ->set('records', $row_data);

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