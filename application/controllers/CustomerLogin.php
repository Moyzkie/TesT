<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class CustomerLogin extends CI_Controller
{
    public function __construct()
    {
       parent::__construct();
       $this->load->helper('form');
       $this->load->library('form_validation');
       if($this->session->has_userdata('authenticated'))
       {
          $this->session->set_flashdata('statuss','Your already login!');
       }else {
          //$this->session->set_flashdata('statuss','Login first!');
          
         
       }
       
    }

   public function login_form()
   {
      $this->load->view("templates/header");
      $this->load->view("CustomerPages/login");
      $this->load->view("templates/footer");
   }

   public function login()
   {
     $this->form_validation->set_rules('email','Email Address','trim|required|valid_email');
     $this->form_validation->set_rules('password','Password','trim|required|md5');
     if($this->form_validation->run()==FALSE)
     {
       $this->login_form();
     }else {
      
      $data=[
          'Email' =>$this->input->post('email'),
          'Password' =>$this->input->post('password')
      ];
      $user_login = new Login_Model;
      $result = $user_login->login($data);
        if($result !==FALSE){

          if($result->Verify == 0)
          {
            $this->session->set_flashdata('statuss','Please verify your account first!');
            redirect(base_url('login'));
          }else {
            $auth_customerdetails=[
              'Full_Name' => $result->Full_Name
            ];
            $this->session->set_userdata('authenticated','1');
            $this->session->set_userdata('auth_customer',$auth_customerdetails);
            $this->session->set_flashdata('statuss','Login Sucessfully!');
            redirect(base_url('home'));
   
          }
        }else{
         $this->session->set_flashdata('statuss','Invalid email or password!');
         redirect(base_url('login'));
       }

      

     }
   }


} 