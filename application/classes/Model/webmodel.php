<?php

defined('SYSPATH') or die('No direct script access.');

class Model_Webmodel extends Model {

    public static $view1 = "view_percentage_difference";
    public static $view2 = "view_day_breakdown";
    public static $view3 = "view_week_breakdown";
    public static $view4 = "view_month_breakdown";
    public static $record = "view_record";
    public static $day_record = "view_day_record";
    public static $devices = "view_devices";
    
    public function list_devices(){
         $results = DB::select()
                ->from(self::$devices)
                ->execute()
                ->as_array();

        return $results;
        
    }
    
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
    public function getHourAverage($device_id) {

        $results = DB::select()
                ->from('view_hourly_average')
                ->execute()
                ->as_array();

        return $results;
    }

    // Returns the daily average 
    public function getDailyAverage($device_id) {

        $results = DB::select()
                ->from('view_day_hourly_average')
                ->execute()
                ->as_array();

        return $results;
    }

    // Return hours of day
    public function getDailyBreakdown($device_id) {
        $results = DB::select()
                ->from(self::$view2)
                ->execute()
                ->as_array();
        return $results;
    }

    // Return days of week
    public function getWeeklyBreakdown($device_id) {
        $results = DB::select()
                ->from(self::$view3)
                ->execute()
                ->as_array();
        return $results;
    }

    // Return weeks of month
    public function getMonthlyBreakdown($device_id) {
        $results = DB::select()
                ->from(self::$view4)
                ->execute()
                ->as_array();
        return $results;
    }
    
    // Return all records
    public function getRecord($device_id) {
        $results = DB::select()
                ->from(self::$record)
                ->execute()
                ->as_array();
        return $results;
    }

      
    // Return day records
    public function getDayRecord($device_id) {
        $results = DB::select()
                ->from(self::$day_record)
                ->execute()
                ->as_array();
        return $results;
    }
    
    // Returns the current reading
    public function getCurrent($device_id) {

        $results = DB::select()
                ->from('view_current_data')
                ->execute()
                ->as_array();

        return $results;
    }

    // Returns the current reading
    public function getOverallAverage($device_id) {

        $results = DB::select()
                ->from('view_overall_average')
                ->execute()
                ->as_array();

        return $results;
    }

    // Returns the percentage change
    public function getPercentageDifference($device_id) {
        $results = DB::select('percentage_difference')
                ->from(self::$view1)
                ->execute()
                ->as_array();

        if (!empty($results))
        {
            if ($results[0]['percentage_difference'] > 10.00)
            {
                return 'TRUE';
            }
            elseif ($results[0]['percentage_difference'] < -10.00)
            {
                return 'FALSE';
            }
        }
        return 'NULL';
    }

    public static function getDeviceByCode($deviceCode){
        $value = DB::select('id')
                ->from('webservice_devices')
                ->where('device_id', '=', $deviceCode)
                ->execute()
                ->as_array();

        if (!empty($value) && isset($value[0]))
        {
            return $value[0];
        }
        else
        {
            return 0;
        }
    }

    // Save data to database
    public static function save($temp, $humid, $device) {
            
        $device = $this->getDeviceByCode($device);
        
        $results = DB::insert('webservice_temperature', array('device_id', 'date', 'temperature', 'humidity'))
                ->values(array(DB::expr($device,'NOW()'), $temp, $humid))
                ->execute();
    }

}

?>