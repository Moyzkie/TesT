<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class authentication extends CI_Model{
    
    public function __construct()
    {
       parent:: __construct();
        
       if(!$this->session->has_userdata('authenticated'))
       {
         $userdata = $this->session->userdata('user_data');
         $authenticated =  $this->session->has_userdata('google_authenticated');
       }else {
         $authenticated  =$this->session->has_userdata('authenticated');
         $userdata = $this->session->userdata('auth_customer');
       }

       if($authenticated)
       {
          if($this->session->userdata('user_data')=='1'){
           
            }
       }else{
          $this->session->set_flashdata('statuss','Login first!');
          redirect(base_url('login')); 
       }
    
    }
}