<?php
class TimeInModel extends CI_Model
{
    // Get All
    public function get_all_time_in()
    {
        $this->db->select('e.first_name,e.last_name, ti.*')
            ->from('time_in as ti')
            ->join('employee as e', 'e.employee_id = ti.employee_id');

        $query = $this->db->get();

        return $query->result();
    }

    // Get One
    public function get_one_time_in($id)
    {
        $this->db->where('time_in_id', $id);
        $query = $this->db->get('time_in');

        return $query->result();
    }

    // Create
    public function create_time_in($data)
    {
        $this->db->like('time_log', date('Y-m-d'));
        $query = $this->db->get('time_in');


        if ($query->num_rows() > 0) {
            return array(
                'message' => "Employee already Time in",
                'status_code' => 422
            );
        }else {

            if ($this->db->insert('time_in', $data)) {
                return array(
                    'message' => "Employee Successfully Time in",
                    'status_code' => 201
                );
            } else {
                
                log_message('error', $this->db->_error_message());
            }
    
                }
    }

    // Delete
    public function delete_time_in($id, $data)
    {
        $this->db->where('time_in_id', $id);
        $this->db->update('time_in', $data);
    }
}
