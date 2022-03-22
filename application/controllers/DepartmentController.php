<?php
defined('BASEPATH') or exit('No direct script access allowed');

class DepartmentController extends CI_Controller
{


	public function __construct()
	{
		parent::__construct();
		!$this->session->userdata('TOKEN') && redirect(base_url());

		$this->load->database();

		$this->load->model('DepartmentModel');
	}


	public function department_page()
	{
		$this->load->view('template/header');
		$this->load->view('template/sidebar');
		$this->load->view('pages/department');
		$this->load->view('template/footer');
	}

	// Function to Get One
	public function get_one_department($id)
	{
		echo json_encode($this->DepartmentModel->get_one_department($id));
	}

	// Function to Get All
	public function get_all_department()
	{
		echo json_encode($this->DepartmentModel->get_all_department());
	}

	// Function to Create
	public function create_department()
	{
		$department_name = $this->input->post('department_name');
		$department_contact_no = $this->input->post('department_contact_no');
		$department_head = $this->input->post('department_head');

		$data = array(
			'department_name' => $department_name,
			'department_contact_no' => $department_contact_no,
			'department_head' => $department_head,
			'status' => 'Active',
			'created_at' => date('Y-m-d H:i:s'),

		);

		$this->DepartmentModel->create_department($data);


		// echo json_encode(array(
		// 	"statusCode"=>200
		// ));
	}


	// Function to Update
	public function update_department($id)
	{
		$department_name = $this->input->post('department_name');
		$department_contact_no = $this->input->post('department_contact_no');
		$department_head = $this->input->post('department_head');

		$data = array(
			'department_name' => $department_name,
			'department_contact_no' => $department_contact_no,
			'department_head' => $department_head,
			'updated_at' => date('Y-m-d H:i:s'),

		);

		$this->DepartmentModel->update_department($id,$data);

	}


	// Function to Delete/Deactivate
	public function delete_department($id)
	{
		$data = array(
			'status' => 'Inactive',
		);
		$this->DepartmentModel->delete_department($id,$data);
	}
}
