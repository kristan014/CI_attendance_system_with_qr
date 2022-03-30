<?php
class UserModel extends CI_Model{
 
    // Get All
    public function get_all_user()
    {
        $this->db->select('u.*, e.first_name,e.last_name')
        ->from('user as u')
        ->join('employee as e', 'e.employee_id = u.employee_id')
        ->where('u.status', 'Active');
        $query = $this->db->get();

        return $query->result();
    }

    // Get One
    public function get_one_user($id)
    {
        $this->db->where('user_id', $id);
        $query = $this->db->get('user');

        return $query->result();
    }

    // Create
    public function create_user($data)
    {
        if ($this->db->insert('user', $data)) {
            return true;
        } else {
            echo $this->db->error();
        }
    }


    // Update
    public function update_user($id,$data)
    {
        $this->db->where('user_id', $id);
        $this->db->update('user', $data);
   
    }

    // Delete
    public function delete_user($id,$data)
    {
        $this->db->where('user_id', $id);
        $this->db->update('user', $data);

    }

    // Login
    function login($email, $password)  
    {  
        $this->db->where('email', $email);  
        $this->db->select('user_id, password'); 
        $query = $this->db->get('user');  
        $result = $query->row_array(); 

         if(!empty($result) && password_verify($password, $result['password']))  
         {  
              return $result;  
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