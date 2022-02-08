<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class CustomerLogin extends CI_Controller
{
    public $data;
    public function __construct()
    {
      
       parent::__construct();
       $this->load->helper('form');
       $this->load->library('form_validation');
       
       
    }

   public function login_Form()
   {
     $bool=true;
    include_once APPPATH . "libraries/vendor/autoload.php";

    $google_client = new Google_Client();
  
    $google_client->setClientId('843424078053-2a877cb7jtk9pguoq6a9acnakg975pdv.apps.googleusercontent.com'); //Define your ClientID
  
    $google_client->setClientSecret('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'); //Define your Client Secret Key
  
    $google_client->setRedirectUri('http://localhost:8000/PharmacyV.1'); //Define your Redirect Uri
  
    $google_client->addScope('email');
  
    $google_client->addScope('profile');

  
    if(isset($_GET["code"]))
    {
     $token = $google_client->fetchAccessTokenWithAuthCode($_GET["code"]);
  
     if(!isset($token["error"]))
     {
      $google_client->setAccessToken($token['access_token']);
  
      $this->session->set_userdata('access_token', $token['access_token']);
  
      $google_service = new Google_Service_Oauth2($google_client);
  
      $info = $google_service->userinfo->get();
  
      $current_datetime = date('Y-m-d H:i:s');
      
      $check_email = $this->Google_Login->Is_already_register($info['email']);
      
      $check_password = new Google_Login;
        
      $result =$check_password->check_password($info['email']);
     
      if($check_email)
      {
      
        if($result->Password=="")
       {
        //update data
        $user_data = array(
          'Full_Name' => $info['given_name'].' '.$info['family_name'],
          'Email' => $info['email']
         );
         $this->Google_Login->Update_user_data($user_data, $info['id']);
       }else {
         $this->session->unset_userdata('access_token');

        $this->session->unset_userdata('google_authenticated');

        $this->session->unset_userdata('user_data');
          redirect('login');
        } 
      }
      else
      {
       //insert data
         $user_data = array(
            'Customer_id' => $info['id'],
            'Full_Name' => $info['given_name'].' '.$info['family_name'],
            'Email'  => $info['email'],
            'Gender'  => $info['gender'],
            'Verify'  => 1,
            'Created_at'  => $current_datetime
           );
         $this->Google_Login->Insert_user_data($user_data);
      }
        $this->session->set_userdata('google_authenticated','1');
        $this->session->set_userdata('user_data', $user_data);
      
     }
    }
    
    if(!$this->session->userdata('access_token'))
    {
      $data['data'] = $google_client->createAuthUrl();
      $this->load->view("templates/header");
      $this->load->view("CustomerPages/login",$data);
      $this->load->view("templates/footer");
    }else {
      $this->load->view("templates/header");
      $this->load->view("CustomerPages/home");
      $this->load->view("templates/footer");
    }
    
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