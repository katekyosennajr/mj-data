<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Products extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->model('product_model');
        $this->load->helper('url');
    }
    
    // List all products
    public function index()
    {
        $search = $this->input->get('search');
        $data['products'] = $this->product_model->get_all_products($search);
        $this->load->view('products/index', $data);
    }
    
    // Create product form
    public function create() {
        $this->load->view('products/create');
    }
    
    // Store new product
    public function store() {
        $data = array(
            'name' => $this->input->post('name'),
            'price' => $this->input->post('price'),
            'stock' => $this->input->post('stock'),
            'is_sell' => $this->input->post('is_sell') ? 1 : 0
        );
        
        $this->product_model->create_product($data);
        redirect('products');
    }
    
    // Edit product form
    public function edit($id) {
        $data['product'] = $this->product_model->get_product($id);
        $this->load->view('products/edit', $data);
    }
    
    // Update product
    public function update($id) {
        $data = array(
            'name' => $this->input->post('name'),
            'price' => $this->input->post('price'),
            'stock' => $this->input->post('stock'),
            'is_sell' => $this->input->post('is_sell') ? 1 : 0
        );
        
        $this->product_model->update_product($id, $data);
        redirect('products');
    }
    
    // Delete product
    public function delete($id) {
        $this->product_model->delete_product($id);
        redirect('products');
    }
}
