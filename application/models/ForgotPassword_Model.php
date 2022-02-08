<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ForgotPassword_Model extends CI_Model
{
    public function check_email($email)
    {
        $sql = "SELECT Email FROM customer_detail WHERE Email = ?";
        $data = array($email);
        return  $this->db->query($sql,$data);
    }

    public function check_verify($recovery_token)
    {
        $this->db->select('Code,Verify');
        $this->db->from('customer_detail');
        $this->db->where('Code', $recovery_token);
        $this->db->limit(1);
        $query = $this->db->get(); 
        if($query->num_rows()==1){
        return $query->row();
        }else{
        return false;
        }
    }
    

    public function update_token($recovery_token,$email)
    {
        $sql  = "UPDATE customer_detail SET Code= ? WHERE Email = ? LIMIT 1";
        $data = array($recovery_token,$email);
        return  $this->db->query($sql,$data);
    }

    
    public function update_verify_status($verify_status,$recovery_token)
    {
        $sql  = "UPDATE customer_detail SET Verify= ? WHERE Code = ? LIMIT 1";
        $data = array($verify_status,$recovery_token);
        return  $this->db->query($sql,$data);
    }

    public function update_password($password,$recovery_token)
     {
        $sql  = "UPDATE customer_detail SET Password= ? WHERE Code = ? LIMIT 1";
        $data = array($password,$recovery_token);
        return  $this->db->query($sql,$data);
     }
    
   
   




}



?>