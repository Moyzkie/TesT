<?php

class RegisterModel  extends CI_Model
{

     public function Register_User($data)
     { 
       return $this->db->insert('customer',$data);
     }


}

?>



