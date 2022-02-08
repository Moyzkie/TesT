<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
class Login_Model extends CI_Model
{

    public function login($data)
    {
     $this->db->select('*');
     $this->db->where('Email',$data['Email']);
     $this->db->where('Password',$data['Password']);
     $this->db->from('customer_detail');
     $this->db->limit(1);
     $query = $this->db->get(); 
     if($query->num_rows()==1){
     return $query->row();
     }else{
     return false;
     }
    }
    
}



