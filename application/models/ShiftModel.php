<?php
class ShiftModel extends CI_Model
{
    // Get All
    public function get_all_shift()
    {
        $query = $this->db->get('shift');

        return $query->result();
    }

    // Get One
    public function get_one_shift($id)
    {
        $this->db->where('shift_id', $id);
        $query = $this->db->get('shift');

        return $query->result();
    }

    // Create
    public function create_shift($data)
    {
        if ($this->db->insert('shift', $data)) {
            return true;
        } else {
            echo $this->db->error();
        }
    }


    // Update
    public function update_shift($id,$data)
    {
        $this->db->where('shift_id', $id);
        $this->db->update('shift', $data);
   
    }

    // Delete
    public function delete_shift($id,$data)
    {
        $this->db->where('shift_id', $id);
        $this->db->update('shift', $data);

    }
}
