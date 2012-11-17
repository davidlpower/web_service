<?php

defined('SYSPATH') or die('No direct script access.');

class Controller_Admin extends Controller {

    public function action_index() {
        $id = $this->request->param('id');
        $temperature = $this->request->query('temperature');
        $humidity = $this->request->query('humidity');

        $head = '<title>ARDUINO LOGGER</title>';
        $body = 'Temperature: ' . $temperature . ' Humidity: ' . $humidity;

        $this->response->body("<html><head>" . $head . "</head><body>" . $body . "</body></html>");
    }

}

// End Admin
