<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Products extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->model('product_model');
        $this->load->library('form_validation');
        $this->load->library('session');
        $this->load->helper('url');
    }
    
    // List all products
    public function index()
    {
        $search = $this->input->get('search');
        $sort_by = $this->input->get('sort_by');
        $sort_order = $this->input->get('sort_order');

        $data['products'] = $this->product_model->get_all_products($search, $sort_by, $sort_order);
        $data['sort_by'] = $sort_by;
        $data['sort_order'] = $sort_order;
        
        $this->load->view('products/index', $data);
    }
    
    // Create product form
    public function create() {
        $this->load->view('products/create');
    }
    
    // Store new product
    public function store()
    {
        $this->form_validation->set_rules('name', 'Nama Produk', 'required|max_length[255]');
        $this->form_validation->set_rules('price', 'Harga', 'required|numeric|greater_than[0]');
        $this->form_validation->set_rules('stock', 'Stok', 'required|integer|greater_than_equal_to[0]');

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('error', validation_errors());
        } else {
            $data = array(
                'name' => $this->input->post('name'),
                'price' => $this->input->post('price'),
                'stock' => $this->input->post('stock'),
                'is_sell' => $this->input->post('is_sell') ? 1 : 0,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            );

            if ($this->product_model->create_product($data)) {
                $this->session->set_flashdata('success', 'Produk berhasil ditambahkan!');
            } else {
                $this->session->set_flashdata('error', 'Gagal menambahkan produk!');
            }
        }
        redirect('products');
    }
    
    // Edit product form
    public function edit($id)
    {
        $data['product'] = $this->product_model->get_product($id);
        if (empty($data['product'])) {
            $this->session->set_flashdata('error', 'Produk tidak ditemukan!');
            redirect('products');
        }
        $this->load->view('products/edit', $data);
    }
    
    // Update product
    public function update($id)
    {
        $this->form_validation->set_rules('name', 'Nama Produk', 'required|max_length[255]');
        $this->form_validation->set_rules('price', 'Harga', 'required|numeric|greater_than[0]');
        $this->form_validation->set_rules('stock', 'Stok', 'required|integer|greater_than_equal_to[0]');

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('error', validation_errors());
            redirect('products/edit/'.$id);
        } else {
            $data = array(
                'name' => $this->input->post('name'),
                'price' => $this->input->post('price'),
                'stock' => $this->input->post('stock'),
                'is_sell' => $this->input->post('is_sell') ? 1 : 0,
                'updated_at' => date('Y-m-d H:i:s')
            );

            if ($this->product_model->update_product($id, $data)) {
                $this->session->set_flashdata('success', 'Produk berhasil diperbarui!');
                redirect('products');
            } else {
                $this->session->set_flashdata('error', 'Gagal memperbarui produk!');
                redirect('products/edit/'.$id);
            }
        }
    }
    
    // Delete product
    public function delete($id)
    {
        $product = $this->product_model->get_product($id);
        if (empty($product)) {
            $this->session->set_flashdata('error', 'Produk tidak ditemukan!');
        } else {
            if ($this->product_model->delete_product($id)) {
                $this->session->set_flashdata('success', 'Produk berhasil dihapus!');
            } else {
                $this->session->set_flashdata('error', 'Gagal menghapus produk!');
            }
        }
        redirect('products');
    }
}
