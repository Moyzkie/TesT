<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Signup_Model  extends CI_Model{
    //Ang laman ng data ay ilalagay natin sa  database 
    public function signup($data){ 
     $sql = "INSERT INTO customer_detail (User_Name, Full_Name , Gender , Age , Contact_No , Email , Password,Created_at,Code) VALUES ?";
     $data = array($data);
     return $this->db->query($sql,$data);
    }
     
    public function cheack_email($entered_email){
     $sql = "SELECT Email FROM customer_detail WHERE Email = ?";
     $data = array($entered_email);
     return  $this->db->query($sql,$data);
    }

    public function cheack_number($entered_number){
     $sql = "SELECT Contact_No FROM customer_detail WHERE Contact_No = ?";
     $data = array($entered_number);
     return  $this->db->query($sql,$data);
    }



}

?>



