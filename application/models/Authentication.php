<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class authentication extends CI_Model{
    
    public function __construct()
    {
       parent:: __construct();

       if($this->session->has_userdata('authenticated'))
       {
          if($this->session->userdata('authenticated')=='1'){
           
            }
       }else{
          $this->session->set_flashdata('statuss','Login first!');
          redirect(base_url('login')); 
       }
    
    }
}