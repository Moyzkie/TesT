<?php

class Pages extends  CI_Controller
{
    public function __construct()
    {
       parent::__construct();
       $this->load->helper('form');
       $this->load->library('form_validation');
    }
    public function view($page = "home")
    {
       if(!file_exists(APPPATH.'views/pages/'.$page.'.php'))
       {
         show_404();
       }
       
       $this->load->view('templates/header');
       $this->load->view('pages/'.$page);
       $this->load->view('templates/footer');
    }

    public function login()
    {
       $this->load->view('templates/header');
       $this->load->view('pages/'."login");
       $this->load->view('templates/footer');
    }


    public function register()
    {
      $this->form_validation->set_rules('username','Username','trim|required|alpha');
      $this->form_validation->set_rules('email','Email','trim|required|valid_email');
      $this->form_validation->set_rules('password','Password','trim|required|md5');
      $this->form_validation->set_rules('confirm-password','confirm-Password','trim|required|matches[password]|md5');
      if($this->form_validation->run()==FALSE)
      {
        $this->login_form();
      }else{
       
        $data = array (
          'Full_Name' => $this->input->post('username'),
          'Email' => $this->input->post('email'),
          'Password' => $this->input->post('password')
        );
        $regiter_user = new RegisterModel;
        $regiter_user->Register_User($data);

        
     }

    }

    
}

   
    

