<?php

defined('SYSPATH') or die('No direct script access.');

class Controller_Admin extends Controller {

    public function action_index() {

        $temperature = $this->request->query('temperature');
        $humidity = $this->request->query('humidity');
        $device = $this->request->query('device');

        $head = '<title>ARDUINO LOGGER</title>';
        $body = 'Device: ' . $device . '<br /> Temperature: ' . $temperature . '<br /> Humidity: ' . $humidity;
        
        $service = new Model_Webmodel();

        $result = $service->getDevice($device);
        
        if ($result == TRUE)
        {
            echo 'Registered';
            $service->save($temperature,$humidity);
        }
        else
        {
            echo 'Not Registered';
        }
        
        echo '<br /><br />';
        $this->response->body("<html><head>" . $head . "</head><body>" . $body . "</body></html>");
    }

    public function action_save() {

        $temperature = $this->request->query('temperature');
        $humidity = $this->request->query('humidity');
        $device = $this->request->query('device');

        $service = new Model_Webmodel();

        $data = $service->getDevice('168CC2CDE1926121FDB78164D5B237C626E33121DC08B048C37B2BE5DFF4B8F1');

        $this->response->body(1);
    }

}

// End Admin
