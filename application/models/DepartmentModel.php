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
        $this->db->where('department_name', $data['department_name']);
        $query = $this->db->get('department');

        if ($query->num_rows() > 0) {
            return array(
                'message' => "Department is already exist",
                'status_code' => 404
            );
        } else {

            if ($this->db->insert('department', $data)) {
                return array(
                    'message' => "Department Successfully Created",
                    'status_code' => 201
                );
            } else {
                log_message('error', $this->db->_error_message());
            }
        }
    }



    public function update_department($id, $data)
    {
        $this->db->where('department_name', $data['department_name'])
        ->where('department_id !=', $id);
        $query = $this->db->get('department');

        if ($query->num_rows() > 0) {
            return array(
                'message' => "Department is already exist",
                'status_code' => 404
            );
        } else {
            $this->db->where('department_id', $id);

            if ($this->db->update('department', $data)) {
                return array(
                    'message' => "Department Successfully Updated",
                    'status_code' => 201
                );
            } else {
                log_message('error', $this->db->_error_message());
            }
        }
    }

    public function delete_department($id, $data)
    {
        $this->db->where('department_id', $id);
        $this->db->update('department', $data);
    }
}
