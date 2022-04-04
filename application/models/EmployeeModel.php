<?php
class EmployeeModel extends CI_Model
{
    // Get All
    public function get_all_employee()
    {
        $this->db->select('e.*, jb.job_title_name')
        ->from('employee as e')
        ->join('job_title as jb', 'e.job_title_id = jb.job_title_id')
        ->where('e.status', 'Active');
        $query = $this->db->get();

        return $query->result();
    }

    // Get One by id
    public function get_one_employee($id)
    {
        $this->db->where('employee_id', $id);
        $query = $this->db->get('employee');

        return $query->result();
    }

    // Get One employee by employee number
    public function get_one_employee_by_emp_no($emp_no)
    {
        $this->db->where('employee_no', $emp_no);
        $query = $this->db->get('employee');

        return $query->result();
    }

    // Create
    public function create_employee($data)
    {
 

        $this->db->where('first_name', $data['first_name'])
        ->where('last_name', $data['last_name'])
        ->where('middle_name', $data['middle_name']);
        $query = $this->db->get('employee');

        if ($query->num_rows() > 0) {
            return array(
                'message' => "Employee is already exist",
                'status_code' => 404
            );
        } else {

            if ($this->db->insert('employee', $data)) {
                return array(
                    'message' => "Employee Successfully Created",
                    'status_code' => 201
                );
            } else {
                log_message('error', $this->db->_error_message());
            }
        }
    }


    // Update
    public function update_employee($id,$data)
    {
        $query_name = $this->db->where('first_name', $data['first_name'])
        ->where('last_name', $data['last_name'])
        ->where('middle_name', $data['middle_name'])
        ->where('employee_id !=', $id)
        ->get('employee');


        $query_email = $this->db->where('email', $data['email'])
        ->where('employee_id !=', $id)
        ->get('employee');

        $query_cellphone_no = $this->db->where('cellphone_no', $data['cellphone_no'])
        ->where('employee_id !=', $id)
        ->get('employee');


        if ($query_name->num_rows() > 0) {
            return array(
                'message' => "Employee is already exist",
                'status_code' => 404
            );
        }
        if($query_email->num_rows() > 0){
            return array(
                'message' => "Email is already exist",
                'status_code' => 404
            );
        }
        if($query_cellphone_no->num_rows() > 0){
            return array(
                'message' => "Cellphone number is already exist",
                'status_code' => 404
            );
        } else {
            $this->db->where('employee_id', $id);

            if ($this->db->update('employee', $data)) {
                return array(
                    'message' => "Employee Successfully Updated",
                    'status_code' => 201
                );
            } else {
                log_message('error', $this->db->_error_message());
            }
        }
   
    }

    // Delete
    public function delete_employee($id,$data)
    {
        $this->db->where('employee_id', $id);
        $this->db->update('employee', $data);

    }

    // Generate random employee number
    public function generate_emp_no()
    {

        $this->db->select('FLOOR(RAND() * 99999) AS random_num')
        ->from('employee')
        ->where_not_in('employee_no','random_num');
        $query = $this->db->get();
        return $query->row_array();

    }
}
