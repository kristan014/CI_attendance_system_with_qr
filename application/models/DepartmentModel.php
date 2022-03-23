<?php
class DepartmentModel extends CI_Model
{

    public function get_all_department()
    {
        $this->db->where('status', 'Active');
        $query = $this->db->get('department');

        return $query->result();
    }

    public function get_one_department($id)
    {
        $this->db->where('department_id', $id);
        $query = $this->db->get('department');

        return $query->result();
    }


    public function create_department($data)
    {
        if ($this->db->insert('department', $data)) {
            return true;
        } else {
            echo $this->db->error();
        }
    }



    public function update_department($id,$data)
    {
        $this->db->where('department_id', $id);
        $this->db->update('department', $data);
   
    }

    public function delete_department($id,$data)
    {
        $this->db->where('department_id', $id);
        $this->db->update('department', $data);

    }
}
