<?php

defined('SYSPATH') or die('No direct script access.');

class Controller_Admin extends Controller {

    public function action_index() {
        
        $id = $this->request->param('id');
        
        $view = View::factory('index');


        $view->head = '<html><head></head>';
        $view->body = '<body>The ID is: ' . $id . '</body>';
        $view->foot = '</html>';

        $index_page = $view->render();
        // The view will have $places and $user variables
        $this->request->response = $index_page;
    }

}

// End Admin
