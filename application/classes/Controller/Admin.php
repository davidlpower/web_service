<?php

defined('SYSPATH') or die('No direct script access.');

class Controller_Admin extends Controller {

    public function action_index() {
        
        $temperature = $this->request->query('temperature');
        $humidity = $this->request->query('humidity');

        $head = '<title>ARDUINO LOGGER</title>';
        $body = 'Temperature: ' . $temperature . ' Humidity: ' . $humidity;
        
        $service = new Model_Webmodel();
        // $service = new Model_Webmodel();
        
        $data = $service->getDevices();
        
        $this->response->body("<html><head>" . $head . "</head><body>" . $body . "</body></html>");
    }

}

// End Admin
