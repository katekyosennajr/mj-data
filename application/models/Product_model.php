<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product_model extends CI_Model {
    
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }
    
    // Get all products
    public function get_all_products($search = null, $sort_by = 'id', $sort_order = 'desc') {
        if ($search) {
            $this->db->like('name', $search);
        }

        // Validasi kolom yang diizinkan untuk sorting
        $allowed_columns = ['name', 'price', 'stock', 'id'];
        $sort_by = in_array($sort_by, $allowed_columns) ? $sort_by : 'id';
        $sort_order = strtolower($sort_order) === 'asc' ? 'asc' : 'desc';

        $this->db->order_by($sort_by, $sort_order);
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
