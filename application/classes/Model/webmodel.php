<?php

defined('SYSPATH') or die('No direct script access.');

class Model_Webmodel extends Model {

    public static function get_all_devices() {

        $results = DB::select()
                ->from('webservice_devices')
                ->as_object()
                ->execute();
        return $results;
    }

    public function all_categories() {

        $results = DB::select()
                ->from('post_category')
                ->execute();
        $array = array();

        foreach ($results as $id => $category) {
            $array[$category['id']] = $category['category'];
        }

        return $array;
    }

    public function get_type($id) {

        $results = DB::select('type')
                ->from('posts')
                ->where('id', '=', $id)
                ->execute()
                ->current();
        return $results;
    }

}