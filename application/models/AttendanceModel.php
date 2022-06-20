<?php
class AttendanceModel extends CI_Model
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
    public function get_one_attendance($time_in_id,$time_out_id)
    {
        $this->db->where('time_out_id', $time_out_id);
        $this->db->where('time_in_id', $time_in_id);
        $query = $this->db->get('attendance');

        return $query->result();
    }

    // Create
    public function create_attendance($data)
    {
            if ($this->db->insert('attendance', $data)) {
                return array(
                    'message' => "Attendance Successfully Recorded",
                    'status_code' => 201
                );
            } else {
                
                log_message('error', $this->db->_error_message());
            }
    
                
    }

    // Delete
    public function delete_attendance($time_in_id, $time_out_id)
    {
        $this->db->where('time_out_id', $time_out_id);
        $this->db->where('time_in_id', $time_in_id);
      
    }
}
