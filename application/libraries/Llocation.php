<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Llocation {

    //Retrieve  location List	
    public function location_list() {
        $CI = & get_instance();
        $CI->load->model('Locations');
        $location_list = $CI->Locations->location_list();  //It will get only Credit locations
        $i = 0;
        $total = 0;
        if (!empty($location_list)) {
            foreach ($location_list as $k => $v) {
                $i++;
                $location_list[$k]['sl'] = $i + $CI->uri->segment(3);
            }
        }
        $data = array(
            'title' => display('manage_location'),
            'location_list' => $location_list,
        );
        $locationList = $CI->parser->parse('location/location', $data, true);
        return $locationList;
    }

    //Sub location Add
    public function location_add_form() {
        $CI = & get_instance();
        $CI->load->model('Locations');
        $data = array(
            'title' => display('add_location')
        );
        $locationForm = $CI->parser->parse('location/add_location_form', $data, true);
        return $locationForm;
    }

    //location Edit Data
    public function location_edit_data($location_id) {
        $CI = & get_instance();
        $CI->load->model('Locations');
        $location_detail = $CI->Locations->retrieve_location_editdata($location_id);

        $data = array(
            'title' => display('location_edit'),
            'location_id' => $location_detail[0]['location_id'],
            'location_name' => $location_detail[0]['location_name'],
            'status' => $location_detail[0]['status']
        );
        $chapterList = $CI->parser->parse('location/edit_location_form', $data, true);
        return $chapterList;
    }

}

?>