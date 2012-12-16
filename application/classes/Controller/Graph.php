<?php

defined('SYSPATH') or die('No direct script access.');

class Controller_Graph extends Controller {

    public function action_index() {

        // Get the list of devices
        $services_model = new Model_Webmodel();
        $device = $services_model->list_devices();
        
        $view = View::factory('graphs')
                ->set('device', $device);
        
        echo $view->render();
    }

    // Daily
    public function action_daily() {
        
        $id = $this->request->param('id');
        $db_model = new Model_Webmodel();
        $data = $db_model->getDailyBreakdown($id);

        $view = View::factory('daily')
                ->set('graph_data', $data);

        echo $view->render();
    }

        // Create javascript data rows
    public function create_jsData($data, $mode = 'record') {

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
            $row_data .= $date[0] . ', ' . (($date[1])-1) . ', ' . $date[2] . ', ';

            // save the time values
            $row_data .= $time[0] . ', ' . $time[1];

            // Pick the right table col names
            if ($mode == 'record')
            {
                $row_data .= '), ' . $value['temperature'] . ', ' . $value['humidity'] . ']';
            }
            else if ($mode == 'daily')
            {
                $row_data .= '), ' . $value['Average_Temp'] . ', ' . $value['Average_Hum'] . ']';
            }
            else
            {
                $row_data .= '), ' . $value[''] . ', ' . $value[''] . ']';
            }

            // Not needed at the end
            if ($outer_counter > 1)
            {
                $row_data .= ',';
            }
            $outer_counter--;
        }
        return $row_data;
    }

    // All Records
    public function action_dailyTimeLine() {
        
        $id = $this->request->param('id');
        
        $db_model = new Model_Webmodel();
        $data = $db_model->getDayRecord($id);


        // Create javascript data rows
        $row_data = $this->create_jsData($data);

        $view = View::factory('daily_timeline')
                ->set('records', $row_data);

        echo $view->render();
    }

    // All Records
    public function action_record() {
        
        $id = $this->request->param('id');
        
        $db_model = new Model_Webmodel();
        $data = $db_model->getRecord($id);

        // Create javascript data rows
        $row_data = $this->create_jsData($data);

        $view = View::factory('record')
                ->set('records', $row_data);

        echo $view->render();
    }

    // Weekly
    public function action_weekly() {
        
        $id = $this->request->param('id');
        
        $db_model = new Model_Webmodel();
        $data = $db_model->getWeeklyBreakdown($id);

        $view = View::factory('weekly')
                ->set('graph_data', $data);

        echo $view->render();
    }

    // Monthly
    public function action_monthly() {
        
        $id = $this->request->param('id');
        
        $db_model = new Model_Webmodel();
        $data = $db_model->getMonthlyBreakdown($id);

        $view = View::factory('monthly')
                ->set('graph_data', $data);

        echo $view->render();
    }

}