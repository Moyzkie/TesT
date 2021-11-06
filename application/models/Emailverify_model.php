<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Emailverify_model extends CI_Model
{

    public function select_email($data)
    {    
        $this->db->select('Code,Verify');
        $this->db->from('customer_detail');
        $this->db->where('Code', $data);
        $this->db->limit(1);
        $query = $this->db->get(); 
        if($query->num_rows()==1){
        return $query->row();
        }else{
        return false;
        }
    }

    public function verify_email($data)
    {
        $sql  = "UPDATE customer_detail SET Verify=3 WHERE Code = ? LIMIT 1";
        $data = array($data);
        return  $this->db->query($sql,$data);
    }

}


?>