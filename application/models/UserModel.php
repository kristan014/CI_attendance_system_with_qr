<?php
class UserModel extends CI_Model{
 
    public function get_all_user()
    {
        $query = $this->db->query('SELECT * FROM user');
        return $query->result();
    }

    public function get_one_user($id)
    {
        $this->db->where('id', $id);  
        $query = $this->db->query('SELECT * FROM user');
        return $query->result();
    }

    function login($email, $password)  
    {  
        $this->db->where('email', $email);  
        $this->db->where('password', $password); 
        $this->db->select('user_id'); 
        $query = $this->db->get('user');  
         if($query->num_rows() > 0)  
         {  
              return $query->result();  
         }  
         else  
         {  
              return false;       
         }  
    }  

    function for_session_details($id)  
    { 
        $this->db->select('d.department_name, jb.job_title_name,e.first_name,e.last_name,e.employee_id')
        ->from('user as u')
        ->join('employee as e', 'e.employee_id = u.employee_id')
        ->join('job_title as jb', 'jb.job_title_id = e.job_title_id')
        ->join('department as d', 'd.department_id = jb.department_id')
        ->where('u.user_id', $id);
        $query =$this->db->get();

        return $query->result();

    }
 
}