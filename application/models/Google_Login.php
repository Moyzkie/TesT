
<?php
class Google_Login extends CI_Model
{
 function Is_already_register($email)
 {
  $this->db->select('*');
  $this->db->where('Email', $email);
  $query = $this->db->get('customer_detail');
  if($query->num_rows() > 0)
  {
   return true;
  }
  else
  {
   return false;
  }
 }

function check_password($email)
{
    $this->db->select('*');
    $this->db->where('Email',$email);
    $this->db->from('customer_detail');
    $this->db->limit(1);
    $query = $this->db->get(); 
    if($query->num_rows()==1){
    return $query->row();
    }else{
    return false;
    }
}

 function Update_user_data($data, $id)
 {
  $this->db->where('Customer_id', $id);
  $this->db->update('customer_detail', $data);
 }

 function Insert_user_data($data)
 {
  $this->db->insert('customer_detail', $data);
 }


}
?>