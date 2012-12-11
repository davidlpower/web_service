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
    public function action_dailyTimeLine() {
        $db_model = new Model_Webmodel();
        $data = $db_model->getDailyBreakdown();

        // Create javascript data rows
        $row_data = $this->create_jsData($data, 'daily');

        $view = View::factory('daily_timeline')
                ->set('records', $row_data);

        echo $view->render();
    }

    //'HH:mm MMMM dd, yyyy', 
    /*
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
     */

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

            //Date(2012, 0 ,1, 13,50)
            // save the date values
            $row_data .= $date[0] . ', ' . $date[1] - 1 . ', ' . $date[2] . ', ';

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
        echo '<PRE>';
        print_r($row_data);
        echo '</PRE>';
        return $row_data;
    }

    // All Records
    public function action_record() {
        $db_model = new Model_Webmodel();
        $data = $db_model->getRecord();

        // Create javascript data rows
        $row_data = $this->create_jsData($data, 'record');

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