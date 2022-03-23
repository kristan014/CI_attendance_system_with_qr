<?php
class EmployeeModel extends CI_Model
{
    // Get All
    public function get_all_employee()
    {
        $query = $this->db->get('employee');

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
}
