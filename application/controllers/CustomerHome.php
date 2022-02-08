<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CustomerHome extends CI_Controller
{
    
    public function __construct()
    {
        parent::__construct();
      
     
    }

    public function Home($page='home')
    {
        if(!file_exists(APPPATH.'views/CustomerPages/'.$page.'.php'))
        {
          show_404();
        }
        $data['userdata']="";
       $this->load->view('templates/header');
       $this->load->view('CustomerPages/home',$data);
       $this->load->view('templates/footer');
    }

}