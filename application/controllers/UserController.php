<?php
defined('BASEPATH') or exit('No direct script access allowed');

class UserController extends CI_Controller
{


	public function __construct()
	{
		parent::__construct();
		$this->load->database();

		//Load the Model here 
		$this->load->model('UserModel');
	}


	public function user_page()
	{
		$this->load->view('template/header');
		$this->load->view('template/sidebar');
		$this->load->view('pages/admin/user');
		$this->load->view('template/footer');
	}

	// Function to Get One
	public function get_one_user($id)
	{
		echo json_encode($this->UserModel->get_one_user($id));
	}

	// Function to Get All
	public function get_all_user()
	{
		echo json_encode($this->UserModel->get_all_user());
	}

	// Function to Create
	public function create_user()
	{
		$email = $this->input->post('email');
		$password = $this->input->post('password');
		$employee_id = $this->input->post('employee_id');

		$data = array(
			'email' => $email,
			'password' => password_hash($password, PASSWORD_BCRYPT),
			'employee_id' => $employee_id,
			'status' => 'Active',
			'created_at' => date('Y-m-d H:i:s'),

		);

		$this->UserModel->create_user($data);


	}


	// Function to Update
	public function update_user($id)
	{
		$email = $this->input->post('email');
		$password = $this->input->post('password');
		$employee_id = $this->input->post('employee_id');

		$data = array(
			'email' => $email,
			'password' => $password,
			'employee_id' => $employee_id,
			'updated_at' => date('Y-m-d H:i:s'),

		);

		$this->UserModel->update_user($id, $data);
	}


	// Function to Delete/Deactivate
	public function delete_user($id)
	{
		$data = array(
			'status' => 'Inactive',
			'updated_at' => date('Y-m-d H:i:s'),

		);
		$this->UserModel->delete_user($id, $data);
	}
}
