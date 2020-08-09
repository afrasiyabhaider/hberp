<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Locations extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    //customer List
    public function location_list() {
        $this->db->select('*');
        $this->db->from('location');
        $this->db->where('status', 1);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }

    //customer List
    public function location_list_product() {
        $this->db->select('*');
        $this->db->from('location');
        $this->db->where('status', 1);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }

    //customer List
    public function location_list_count() {
        $this->db->select('*');
        $this->db->from('location');
        $this->db->where('status', 1);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->num_rows();
        }
        return false;
    }

    //location Search Item
    public function location_search_item($location_id) {
        $this->db->select('*');
        $this->db->from('location');
        $this->db->where('location_id', $location_id);
        $this->db->limit('500');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }

    //Count customer
    public function location_entry($data) {
        $this->db->select('*');
        $this->db->from('location');
        $this->db->where('status', 1);
        $this->db->where('location_name', $data['location_name']);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return FALSE;
        } else {
            $this->db->insert('location', $data);
            return TRUE;
        }
    }

    //Retrieve customer Edit Data
    public function retrieve_location_editdata($location_id) {
        $this->db->select('*');
        $this->db->from('location');
        $this->db->where('location_id', $location_id);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }

    //Update Locations
    public function update_location($data, $location_id) {
        $this->db->where('location_id', $location_id);
        $this->db->update('location', $data);
        return true;
    }

    // Delete customer Item
    public function delete_location($location_id) {
        $this->db->where('location_id', $location_id);
        $this->db->delete('location');
        return true;
    }

}
