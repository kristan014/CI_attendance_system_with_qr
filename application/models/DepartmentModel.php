<?php
class DepartmentModel extends CI_Model
{

    public function get_all_department()
    {
        $query = $this->db->query('SELECT * FROM department');
        return $query->result();
    }

    public function get_one_department($id)
    {
        $this->db->where('id', $id);
        $query = $this->db->query('SELECT * FROM department');
        return $query->result();
    }
}
