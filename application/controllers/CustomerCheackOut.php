<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CustomerCheackOut extends CI_Controller
{
    
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Authentication');
    }

    public function checkout()
    {
       $this->load->view('templates/header');
       $this->load->view('CustomerPages/checkout');
       $this->load->view('templates/footer');
    }
    

}