<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CustomerAccount extends CI_Controller
{
    
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Authentication');
       
    }

    public function myaccount()
    {
       $this->load->view('templates/header');
       $this->load->view('CustomerPages/account');
       $this->load->view('templates/footer');
    }
    

}