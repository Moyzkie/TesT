<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_Dashboard extends CI_Controller
{
    public function __construct()
    {
        parent::__construct(); 
    }

    public function dashboard()
    {
        $this->load->view('templates/admin_header');
        $this->load->view('AdminPages/dashboard');
        $this->load->view('templates/admin_footer');
    }
}
