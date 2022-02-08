<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class EmailVerify extends CI_Controller
{
     function verify()
    {
     
      if(isset($_GET['token']))
      {
         $data =  $_GET['token'];
         $select_email = new Emailverify_model();
         $get_email =  $select_email->select_email($data);
         if($get_email==true)
         {
           if($get_email->Verify==0)
           {
             $cliked_token = $get_email->Code;
             $data = ['cliked_token' =>  $cliked_token];
             $verify_email = $select_email->verify_email($data);
            
             if($verify_email)
             {
                $this->session->set_flashdata('statuss','Your account has been verified Successfully');
                redirect('login');
             }else{
                
                $this->session->set_flashdata('statuss','Verification Failed!');
                redirect('login');
             }

           }else{
             $this->session->set_flashdata('statuss','Email Already Verified. Plase Login!');
             redirect('login');
           }
         }
         
        }else{
          $this->session->set_flashdata('statuss','Not Allowed!');
         redirect('login');
      }
      
    }
}




?>