<?php
class TimeOutModel extends CI_Model
{
    // Get All
    public function get_all_time_out()
    {
        $this->db->select('e.first_name,e.last_name, ti.*')
            ->from('time_out as ti')
            ->joout('employee as e', 'e.employee_id = ti.employee_id');

        $query = $this->db->get();

        return $query->result();
    }

    // Get One
    public function get_one_time_out($id)
    {
        $this->db->where('time_out_id', $id);
        $query = $this->db->get('time_out');

        return $query->result();
    }

    // Create
    public function create_time_out($data)
    {
        $this->db->like('time_log', date('Y-m-d'));
        $query = $this->db->get('time_out');


        if ($query->num_rows() > 0) {
            return array(
                'message' => "Employee already Time out",
                'status_code' => 422
            );
        }else {

            if ($this->db->insert('time_out', $data)) {
                return array(
                    'message' => "Employee Successfully Time out",
                    'status_code' => 201
                );
            } else {
                
                log_message('error', $this->db->_error_message());
            }
    
                }
    }

    // Delete
    public function delete_time_out($id, $data)
    {
        $this->db->where('time_out_id', $id);
        $this->db->update('time_out', $data);
    }
}
