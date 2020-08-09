<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Lstore_location {

    //Retrieve  store_location List	
    public function store_location_list() {
        $CI = & get_instance();
        $CI->load->model('store_location');
        $store_location_list = $CI->store_location->store_location_list();  //It will get only Credit store_location
        $i = 0;
        $total = 0;
        if (!empty($store_location_list)) {
            foreach ($store_location_list as $k => $v) {
                $i++;
                $store_location_list[$k]['sl'] = $i + $CI->uri->segment(3);
            }
        }
        $data = array(
            'title' => display('manage_store_location'),
            'store_location_list' => $store_location_list,
        );
        $store_locationList = $CI->parser->parse('store_location/store_location', $data, true);
        return $store_locationList;
    }

    //Sub store_location Add
    public function store_location_add_form() {
        $CI = & get_instance();
        $CI->load->model('store_location');
        $data = array(
            'title' => display('add_store_location')
        );
        $store_locationForm = $CI->parser->parse('store_location/add_store_location_form', $data, true);
        return $store_locationForm;
    }

    //store_location Edit Data
    public function store_location_edit_data($store_location_id) {
        $CI = & get_instance();
        $CI->load->model('store_location');
        $store_location_detail = $CI->store_location->retrieve_store_location_editdata($store_location_id);

        $data = array(
            'title' => display('store_location_edit'),
            'store_location_id' => $store_location_detail[0]['store_location_id'],
            'store_location_name' => $store_location_detail[0]['store_location_name'],
            'status' => $store_location_detail[0]['status']
        );
        $chapterList = $CI->parser->parse('store_location/edit_store_location_form', $data, true);
        return $chapterList;
    }

}

?>