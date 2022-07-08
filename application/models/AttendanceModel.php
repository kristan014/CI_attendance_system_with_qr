<?php
class AttendanceModel extends CI_Model
{
    // Get All
    public function get_all_attendance()
    {
        $this->db->select('e.first_name,e.last_name, a.*')
            ->from('attendance as a')
            ->join('employee as e', 'e.employee_id = a.employee_id');

        $query = $this->db->get();

        return $query->result();
    }

    // Get One
    public function get_one_attendance($id)
    {
        $this->db->where('attendance_id', $id);
        $query = $this->db->get('attendance');

        return $query->result();
    }

    // Create
    public function create_time_in($data)
    {
        $this->db->where('time_in is NOT NULL')
            ->where('employee_id', $data['employee_id']);
        $query = $this->db->get('attendance');


        if ($query->num_rows() > 0) {
            return array(
                'message' => "Employee already Time in",
                'status_code' => 422
            );
        } else {
            if ($this->db->insert('attendance', $data)) {
                return array(
                    'message' => "Employee Successfully Time in",
                    'status_code' => 201
                );
            } else {

                log_message('error', $this->db->_error_message());
            }
        }
    }

    // Create
    public function create_time_out($data)
    {
        $this->db->where('time_out is NOT NULL')
            ->where('employee_id', $data['employee_id']);
        $query = $this->db->get('attendance');


        if ($query->num_rows() > 0) {
            return array(
                'message' => "Employee already Time out",
                'status_code' => 422
            );
        } else {
            if ($this->db->insert('attendance', $data)) {
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
    public function delete_attendance($id)
    {
        $this->db->where('attendance_id', $id);
    }
}
