<?php
class UserModel extends CI_Model{
 
    public function get_all_user()
    {
        $query = $this->db->query('SELECT * FROM user');
        return $query->result();
    }

    public function get_one_user()
    {
        $query = $this->db->query('SELECT * FROM user');
        return $query->result();
    }

    function login($email, $password)  
    {  
         $this->db->where('email', $email);  
         $this->db->where('password', $password);  
         $query = $this->db->get('user');  
         if($query->num_rows() > 0)  
         {  
              return true;  
         }  
         else  
         {  
              return false;       
         }  
    }  


 
}