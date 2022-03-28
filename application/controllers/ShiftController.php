<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ShiftController extends CI_Controller
{


	public function __construct()
	{
		parent::__construct();
		!$this->session->userdata('TOKEN') && redirect(base_url());

		$this->load->database();

		$this->load->model('ShiftModel');
	}


	public function shift_page()
	{
		$this->load->view('template/header');
		$this->load->view('template/sidebar');
		$this->load->view('pages/employee_management/shift');
		$this->load->view('template/footer');
	}

	// Function to Get One
	public function get_one_shift($id)
	{
		echo json_encode($this->ShiftModel->get_one_shift($id));
	}

	// Function to Get All
	public function get_all_shift()
	{
		echo json_encode($this->ShiftModel->get_all_shift());
	}

	// Function to Create
	public function create_shift()
	{
		$shift_name = $this->input->post('shift_name');
		$shift_contact_no = $this->input->post('shift_contact_no');
		$shift_head = $this->input->post('shift_head');

		$data = array(
			'shift_name' => $shift_name,
			'shift_contact_no' => $shift_contact_no,
			'shift_head' => $shift_head,
			'status' => 'Active',
			'created_at' => date('Y-m-d H:i:s'),

		);

		$this->ShiftModel->create_shift($data);


	}


	// Function to Update
	public function update_shift($id)
	{
		$shift_name = $this->input->post('shift_name');
		$shift_contact_no = $this->input->post('shift_contact_no');
		$shift_head = $this->input->post('shift_head');

		$data = array(
			'shift_name' => $shift_name,
			'shift_contact_no' => $shift_contact_no,
			'shift_head' => $shift_head,
			'updated_at' => date('Y-m-d H:i:s'),

		);

		$this->ShiftModel->update_shift($id,$data);

	}


	// Function to Delete/Deactivate
	public function delete_shift($id)
	{
		$data = array(
			'status' => 'Inactive',
			'updated_at' => date('Y-m-d H:i:s'),

		);
		$this->ShiftModel->delete_shift($id,$data);
	}
}
