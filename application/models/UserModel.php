<?php
class UserModel extends CI_Model{
 
    public function get_user()
    {
        $query = $this->db->query('SELECT * FROM user');
        return $query->result();
    }
 
}