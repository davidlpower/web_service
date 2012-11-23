<?php

defined('SYSPATH') or die('No direct script access.');

class Model_Webmodel extends Model {

    public static $view1 = "view_percentage_difference";

    public function getDevice($device_id) {

        $results = DB::select()
                ->from('webservice_devices')
                ->where('device_id', '=', $device_id)
                ->and_where('allowed', '=', 1)
                ->and_where('deleted', '=', 0)
                ->execute()
                ->as_array();

        if (!empty($results))
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }

    // Returns the hourly average 
    public function getHourAverage() {

        $results = DB::select()
                ->from('view_hourly_average')
                ->execute()
                ->as_array();

        return $results;
    }

    // Returns the daily average 
    public function getDailyAverage() {

        $results = DB::select()
                ->from('view_daily_average')
                ->execute()
                ->as_array();

        return $results;
    }

    // Returns the current reading
    public function getCurrent() {

        $results = DB::select()
                ->from('view_current_data')
                ->execute()
                ->as_array();

        return $results;
    }

    // Returns the current reading
    public function getOverallAverage() {

        $results = DB::select()
                ->from('view_overall_average')
                ->execute()
                ->as_array();

        return $results;
    }

    // Returns the percentage change
    public function getPercentageDifference() {
        $results = DB::select('percentage_difference')
                ->from(self::$view1)
                ->execute()
                ->as_array();

        if (!empty($results))
        {
            if($results[0]['percentage_difference'] > 10.00){
                return 'TRUE';
            }
        }
        return 'FALSE';
    }

    // Save data to database
    public static function save($temp, $humid) {

        $results = DB::insert('webservice_temperature', array('date', 'temperature', 'humidity'))
                ->values(array(DB::expr('NOW()'), $temp, $humid))
                ->execute();
    }

}

?>