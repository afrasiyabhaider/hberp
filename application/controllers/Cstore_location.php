<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Cstore_location extends CI_Controller {

    public $menu;

    function __construct() {
        parent::__construct();
        $this->load->library('auth');
        $this->load->library('lstore_location');
        $this->load->library('session');
        $this->load->model('store_location');
        $this->auth->check_admin_auth();
    }

    //Default loading for store_location system.
    public function index() {
        $content = $this->lstore_location->store_location_add_form();
        $this->template->full_admin_html_view($content);
    }

    //Manage store_location form
    public function manage_store_location() {
        $content = $this->lstore_location->store_location_list();
        $this->template->full_admin_html_view($content);
        
    }

    //Insert store_location and upload
    public function insert_store_location() {
        $store_location_id = $this->auth->generator(15);

        $data = array(
            'store_location_id' => $store_location_id,
            'store_location_name' => $this->input->post('store_location_name'),
            'status' => 1
        );

        $result = $this->store_location->store_location_entry($data);

        if ($result == TRUE) {
            $this->session->set_userdata(array('message' => display('successfully_added')));
            if (isset($_POST['add-customer'])) {
                redirect(base_url('Cstore_location/manage_store_location'));
            } elseif (isset($_POST['add-customer-another'])) {
                redirect(base_url('Cstore_location'));
            }
        } else {
            $this->session->set_userdata(array('error_message' => display('already_inserted')));
            redirect(base_url('Cstore_location'));
        }
    }

    //store_location Update Form
    public function store_location_update_form($store_location_id) {
        $content = $this->lstore_location->store_location_edit_data($store_location_id);
        $this->template->full_admin_html_view($content);
    }

    // store_location Update
    public function store_location_update() {
        $this->load->model('store_location');
        $store_location_id = $this->input->post('store_location_id');
        $data = array(
            'store_location_name' => $this->input->post('store_location_name'),
            'status' => $this->input->post('status'),
        );

        $this->store_location->update_store_location($data, $store_location_id);
        $this->session->set_userdata(array('message' => display('successfully_updated')));
        redirect(base_url('Cstore_location/manage_store_location'));
    }

    // store_location delete
    public function store_location_delete() {
        $this->load->model('store_location');
        $store_location_id = $_POST['store_location_id'];
        $this->store_location->delete_store_location($store_location_id);
        $this->session->set_userdata(array('message' => display('successfully_delete')));
        return true;
    }

}
