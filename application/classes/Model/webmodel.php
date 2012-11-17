<?php

defined('SYSPATH') or die('No direct script access.');

class Model_Webmodel extends Model_Database {

    public function getDevices() {

        $results = DB::select()
                ->from('webservice_devices')
                ->execute();
        
        return $results->as_array();
    }
}
?>