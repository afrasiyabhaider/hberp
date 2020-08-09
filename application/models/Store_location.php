<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Store_location extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    //customer List
    public function store_location_list() {
        $this->db->select('*');
        $this->db->from('store_location');
        $this->db->where('status', 1);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }

    //customer List
    public function store_location_list_product() {
        $this->db->select('*');
        $this->db->from('store_location');
        $this->db->where('status', 1);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }

    //customer List
    public function store_location_list_count() {
        $this->db->select('*');
        $this->db->from('store_location');
        $this->db->where('status', 1);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->num_rows();
        }
        return false;
    }

    //store_location Search Item
    public function store_location_search_item($store_location_id) {
        $this->db->select('*');
        $this->db->from('store_location');
        $this->db->where('store_location_id', $store_location_id);
        $this->db->limit('500');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }

    //Count customer
    public function store_location_entry($data) {
        $this->db->select('*');
        $this->db->from('store_location');
        $this->db->where('status', 1);
        $this->db->where('store_location_name', $data['store_location_name']);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return FALSE;
        } else {
            $this->db->insert('store_location', $data);
            return TRUE;
        }
    }

    //Retrieve customer Edit Data
    public function retrieve_store_location_editdata($store_location_id) {
        $this->db->select('*');
        $this->db->from('store_location');
        $this->db->where('store_location_id', $store_location_id);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }

    //Update store_locations
    public function update_store_location($data, $store_location_id) {
        $this->db->where('store_location_id', $store_location_id);
        $this->db->update('store_location', $data);
        return true;
    }

    // Delete customer Item
    public function delete_store_location($store_location_id) {
        $this->db->where('store_location_id', $store_location_id);
        $this->db->delete('store_location');
        return true;
    }

}
