<?php
class JobTitleModel extends CI_Model
{
    // Get All
    public function get_all_job_title()
    {
        $this->db->select('d.department_name, jb.*')
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
        $this->db->where('job_title_name', $data['job_title_name']);
        $query = $this->db->get('job_title');

        if ($query->num_rows() > 0) {
            return array(
                'message' => "Job Title is already exist",
                'status_code' => 404
            );
        } else {

            if ($this->db->insert('job_title', $data)) {
                return array(
                    'message' => "Job Title Successfully Created",
                    'status_code' => 201
                );
            } else {
                log_message('error', $this->db->_error_message());
            }
        }
    }


    // Update
    public function update_job_title($id, $data)
    {
        $this->db->where('job_title_name', $data['job_title_name'])
            ->where('job_title_id !=', $id);
        $query = $this->db->get('job_title');

        if ($query->num_rows() > 0) {
            return array(
                'message' => "Job Title is already exist",
                'status_code' => 404
            );
        } else {
            $this->db->where('job_title_id', $id);

            if ($this->db->update('job_title', $data)) {
                return array(
                    'message' => "Job Title Successfully Updated",
                    'status_code' => 201
                );
            } else {
                log_message('error', $this->db->_error_message());
            }
        }
    }

    // Delete
    public function delete_job_title($id, $data)
    {
        $this->db->where('job_title_id', $id);
        $this->db->update('job_title', $data);
    }
}
