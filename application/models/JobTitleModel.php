<?php
class JobTitleModel extends CI_Model
{
    // Get All
    public function get_all_job_title()
    {
        $query =  $this->db->select('d.department_name, jb.*')
        ->from('job_title as jb')
        ->join('department as d', 'd.department_id = jb.department_id')
        ->where('jb.status', 'Active');

        $query = $this->db->get();

        return $query->result();
    }

    // Get One
    public function get_one_job_title($id)
    {
        $this->db->where('job_title_id', $id);
        $query = $this->db->get('job_title');

        return $query->result();
    }

    // Create
    public function create_job_title($data)
    {
        if ($this->db->insert('job_title', $data)) {
            return true;
        } else {
            echo $this->db->error();
        }
    }


    // Update
    public function update_job_title($id,$data)
    {
        $this->db->where('job_title_id', $id);
        $this->db->update('job_title', $data);
   
    }

    // Delete
    public function delete_job_title($id,$data)
    {
        $this->db->where('job_title_id', $id);
        $this->db->update('job_title', $data);

    }
}
