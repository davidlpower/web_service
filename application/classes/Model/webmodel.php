<?php

defined('SYSPATH') or die('No direct script access.');

class Model_Webmodel extends ORM {

    public function getDevices() {

        $results = DB::select()
                ->from('webservice_devices')
                ->execute();
        
        return $results->as_array();
    }
}
?>