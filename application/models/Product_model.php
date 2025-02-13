<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product_model extends CI_Model {
    
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }
    
    // Get all products
    public function get_all_products($search = null) {
        if ($search) {
            $this->db->like('name', $search);
        }
        $this->db->order_by('id', 'desc');
        return $this->db->get('products')->result();
    }
    
    // Get product by ID
    public function get_product($id) {
        return $this->db->get_where('products', array('id' => $id))->row();
    }
    
    // Create new product
    public function create_product($data) {
        return $this->db->insert('products', $data);
    }
    
    // Update product
    public function update_product($id, $data) {
        $this->db->where('id', $id);
        return $this->db->update('products', $data);
    }
    
    // Delete product
    public function delete_product($id) {
        return $this->db->delete('products', array('id' => $id));
    }
}
