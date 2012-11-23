<?php

defined('SYSPATH') or die('No direct script access.');

class Controller_Admin extends Controller {

    public function action_index() {

        $temperature = $this->request->query('temperature');
        $humidity = $this->request->query('humidity');
        $device = $this->request->query('device');

        $head = "<title>Arduino Temperature Logger</title>";

        $body = 'Device: ' . $device . '<br /> Temperature: ' . $temperature . '<br /> Humidity: ' . $humidity;

        // Get data from database
        $service = new Model_Webmodel();
        $result = $service->getDevice($device);

        if ($result == TRUE)
        {
            echo 'Registered';
            $service->save($temperature, $humidity);
        }
        else
        {
            echo 'Not Registered';
        }

        echo '<br /><br />';
        $this->response->body("<html><head>" . $head . "</head><body>" . $body . "</body></html>");
    }

}

// End Admin
