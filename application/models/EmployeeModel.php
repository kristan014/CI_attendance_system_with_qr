<?php
class EmployeeModel extends CI_Model
{
    // Get All
    public function get_all_employee()
    {
        $this->db->select('e.*, jb.job_title_name')
        ->from('employee as e')
        ->join('job_title as jb', 'e.job_title_id = jb.job_title_id')
        ->where('e.status', 'Active');
        $query = $this->db->get();

        return $query->result();
    }

    // Get One
    public function get_one_employee($id)
    {
        $this->db->where('employee_id', $id);
        $query = $this->db->get('employee');

        return $query->result();
    }

    // Create
    public function create_employee($data)
    {
        if ($this->db->insert('employee', $data)) {
            return true;
        } else {
            echo $this->db->error();
        }
    }


    // Update
    public function update_employee($id,$data)
    {
        $this->db->where('employee_id', $id);
        $this->db->update('employee', $data);
   
    }

    // Delete
    public function delete_employee($id,$data)
    {
        $this->db->where('employee_id', $id);
        $this->db->update('employee', $data);

    }

    // Generate random employee number
    public function generate_emp_no()
    {

        $this->db->select('FLOOR(RAND() * 99999) AS random_num')
        ->from('employee')
        ->where_not_in('employee_no','random_num');
        $query = $this->db->get();
        return $query->row_array();

    }
}
