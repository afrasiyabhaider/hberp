<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Clocation extends CI_Controller {

    public $menu;

    function __construct() {
        parent::__construct();
        $this->load->library('auth');
        $this->load->library('llocation');
        $this->load->library('session');
        $this->load->model('Locations');
        $this->auth->check_admin_auth();
    }

    //Default loading for location system.
    public function index() {
        $content = $this->llocation->location_add_form();
        $this->template->full_admin_html_view($content);
    }

    //Manage location form
    public function manage_location() {
        $content = $this->llocation->location_list();
        $this->template->full_admin_html_view($content);
        
    }

    //Insert location and upload
    public function insert_location() {
        $location_id = $this->auth->generator(15);

        $data = array(
            'location_id' => $location_id,
            'location_name' => $this->input->post('location_name'),
            'status' => 1
        );

        $result = $this->Locations->location_entry($data);

        if ($result == TRUE) {
            $this->session->set_userdata(array('message' => display('successfully_added')));
            if (isset($_POST['add-customer'])) {
                redirect(base_url('Clocation/manage_location'));
            } elseif (isset($_POST['add-customer-another'])) {
                redirect(base_url('Clocation'));
            }
        } else {
            $this->session->set_userdata(array('error_message' => display('already_inserted')));
            redirect(base_url('Clocation'));
        }
    }

    //location Update Form
    public function location_update_form($location_id) {
        $content = $this->llocation->location_edit_data($location_id);
        $this->template->full_admin_html_view($content);
    }

    // location Update
    public function location_update() {
        $this->load->model('Locations');
        $location_id = $this->input->post('location_id');
        $data = array(
            'location_name' => $this->input->post('location_name'),
            'status' => $this->input->post('status'),
        );

        $this->Locations->update_location($data, $location_id);
        $this->session->set_userdata(array('message' => display('successfully_updated')));
        redirect(base_url('Clocation/manage_location'));
    }

    // location delete
    public function location_delete() {
        $this->load->model('Locations');
        $location_id = $_POST['location_id'];
        $this->Locations->delete_location($location_id);
        $this->session->set_userdata(array('message' => display('successfully_delete')));
        return true;
    }

}
