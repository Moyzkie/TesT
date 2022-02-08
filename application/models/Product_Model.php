<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product_Model extends CI_Model
{
   public function insert_product($data)
   {
      $sql = "INSERT INTO product (Product_Name,Stock,Price,Product_Detail,Category_id,Supplier_id) VALUES ?";
      $data = array($data);
      return $this->db->query($sql,$data);
   }

   public function display_product()
   {
     $query = $this->db->get("product");
     return $query->result();
   }

   public function delete_product($id)
   {
     $this->db->where("Product_id", $id);
     $this->db->delete("product");
     return true;
   }

   public function update($pn,$psk,$pr,$pd,$pc,$ps,$id)
   {
      $query = "UPDATE product SET Product_Name = ? , Stock = ? , Price = ? , Product_Detail =  ? , Category_id = ? , Supplier_id = ?  WHERE Product_id = ?";
      $data= array($pn,$psk,$pr,$pd,$pc,$ps,$id);
      return $this->db->query($query,$data);
   }

 
} 
