<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_Product extends CI_Controller
{
    public function __construct()
    {
        parent::__construct(); 
    }

    public function product()
    {
        $this->load->view('templates/admin_header');
        $this->load->view('AdminPages/products');
        $this->load->view('templates/admin_footer');
    }

    public function addproduct()
    {
       $addproduct = new Product_Model;

       $data = array(
           'Product_Name' => $this->input->post('p_name'),
           'Stock' => $this->input->post('p_stock'),
           'Price' => $this->input->post('p_price'),
           'Product_Detail' => $this->input->post('p_detail'),
           'Category_id' => $this->input->post('p_category'),
           'Supplier_id' => $this->input->post('p_supplier')
       );
         $addproduct->insert_product($data);
         $this->session->set_flashdata('a_status_success','New  Product "'.$data['Product_Name']. '"  Added Successfully!');
         redirect('admin_product');
    }

    public function display_product()
    {
       $result ['data'] = $this->Product_Model->display_product();
       $this->load->view('templates/admin_header');
       $this->load->view('AdminPages/products',$result);
       $this->load->view('templates/admin_footer');
    }

    public function delete_product()
    {
       $id=$this->input->get('Product_id');
       $response=$this->Product_Model->delete_product($id);
       if($response==true){   
            $this->session->set_flashdata('a_status_danger',' Product id = '.$id.'  deleted successfully!');
            redirect('admin_product');
       }
        else{
          echo "Error !";
       }
    }

    public function update_product()
    {
        $update= new Product_Model;
        $id = $this->input->post('e_id');
        $pn = $this->input->post('e_name');
        $psk = $this->input->post('e_stock');
        $pr = $this->input->post('e_price');
        $pd = $this->input->post('e_detail');
        $pc = $this->input->post('e_category');
        $ps = $this->input->post('e_supplier');
        if($update->update($pn,$psk,$pr,$pd,$pc,$ps,$id))
        {
           $this->session->set_flashdata('a_status_success','Product_id=' .$id. ' Update Successfully!');
           redirect('admin_product');
        }else{
            echo "Something wrong";
        }
     
    }
}

