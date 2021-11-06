<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CustomerHome extends CI_Controller
{
    
    public function __construct()
    {
        parent::__construct();
        $this->session->has_userdata('authenticated');
        
    }

    public function Home($page='home')
    {
        if(!file_exists(APPPATH.'views/CustomerPages/'.$page.'.php'))
        {
          show_404();
        }
       $this->load->view('templates/header');
       $this->load->view('CustomerPages/home');
       $this->load->view('templates/footer');
    }

}