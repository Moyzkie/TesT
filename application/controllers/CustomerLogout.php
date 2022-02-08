<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CustomerLogout extends CI_Controller{

    public function  __construct()
    {
        parent::__construct();
        $this->load->model('Authentication');
    }

    public function logout()
    {
        $this->session->unset_userdata('access_token');
        $this->session->unset_userdata('google_authenticated');
        $this->session->unset_userdata('user_data');
        $this->session->unset_userdata('authenticated');
        $this->session->unset_userdata('auth_customer');
        redirect(base_url('login'));
    }
}