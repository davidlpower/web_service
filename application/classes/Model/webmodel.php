<?php

defined('SYSPATH') or die('No direct script access.');

class Model_Webmodel extends Model {

    public function getDevice($device_id) {

        $results = DB::select()
                ->from('webservice_devices')
                ->where('device_id', '=', $device_id)
                ->and_where('allowed', '=', 1)
                ->and_where('deleted', '=', 0)
                ->execute();
        
        echo '<PRE>';
        print_r($results->as_array());
        echo '</PRE>';
        
        if($results) 
        {
            return TRUE;
        }
        else 
        {
            return FALSE;
        }
    }

    public static function save($temp,$humid) {

        $results = DB::insert('webservice_temperature', array('date', 'temperature', 'humidity'))
                ->values(array(DB::expr('NOW()'), $temp, $humid))
                ->execute();
    }

}

?>