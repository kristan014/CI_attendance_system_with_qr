<?php
defined('BASEPATH') or exit('No direct script access allowed');

class EmployeeController extends CI_Controller
{


	public function __construct()
	{
		parent::__construct();
		!$this->session->userdata('TOKEN') && redirect(base_url());

		$this->load->database();

		$this->load->model('EmployeeModel');
	}


	public function employee_page()
	{
		$this->load->view('template/header');
		$this->load->view('template/sidebar');
		$this->load->view('pages/employee_management/employee');
		$this->load->view('template/footer');
	}

	// Function to Get One
	public function get_one_employee($id)
	{
		echo json_encode($this->EmployeeModel->get_one_employee($id));
	}

	// Function to Get All
	public function get_all_employee()
	{
		echo json_encode($this->EmployeeModel->get_all_employee());
	}

	// Function to Create
	public function create_employee()
	{
		$config['upload_path'] = './assets/uploads/';
        $config['allowed_types'] = 'gif|jpg|png';

		$this->load->library('upload', $config);
		// $employee_name = $this->input->post('employee_name');
		// $employee_contact_no = $this->input->post('employee_contact_no');
		// $employee_head = $this->input->post('employee_head');

		// $data = array(
		// 	'employee_name' => $employee_name,
		// 	'employee_contact_no' => $employee_contact_no,
		// 	'employee_head' => $employee_head,
		// 	'status' => 'Active',
		// 	'created_at' => date('Y-m-d H:i:s'),

		// );

		// $this->EmployeeModel->create_employee($data);


		// echo json_encode(array(
		// 	"statusCode"=>200
		// ));
	}


	// Function to Update
	public function update_employee($id)
	{
		$employee_name = $this->input->post('employee_name');
		$employee_contact_no = $this->input->post('employee_contact_no');
		$employee_head = $this->input->post('employee_head');

		$data = array(
			'employee_name' => $employee_name,
			'employee_contact_no' => $employee_contact_no,
			'employee_head' => $employee_head,
			'updated_at' => date('Y-m-d H:i:s'),

		);

		$this->EmployeeModel->update_employee($id,$data);

	}


	// Function to Delete/Deactivate
	public function delete_employee($id)
	{
		$data = array(
			'status' => 'Inactive',
			'updated_at' => date('Y-m-d H:i:s'),

		);
		$this->EmployeeModel->delete_employee($id,$data);
	}
}
