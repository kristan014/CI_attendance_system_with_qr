<?php
defined('BASEPATH') or exit('No direct script access allowed');

class AttendanceController extends CI_Controller
{


	public function __construct()
	{
		parent::__construct();
		!$this->session->userdata('TOKEN') && redirect(base_url());

		$this->load->database();

		$this->load->model('AttendanceModel');
	}


	public function attendance_sheet_page()
	{
		$this->load->view('template/header');
		$this->load->view('template/sidebar');
		$this->load->view('pages/admin/attendance_sheet');
		$this->load->view('template/footer');
	}

	// Function to Get One
	public function get_one_attendance($time_in_id,$time_out_id)
	{
		echo json_encode($this->AttendanceModel->get_one_attendance($time_in_id,$time_out_id));
	}

	// Function to Get All
	public function get_all_attendance()
	{
		echo json_encode($this->AttendanceModel->get_all_attendance());
	}

	// Function to Create
	public function create_attendance()
	{
		$attendance_name = $this->input->post('attendance_name');
		$attendance_contact_no = $this->input->post('attendance_contact_no');
		$attendance_head = $this->input->post('attendance_head');

		$data = array(
			'attendance_name' => $attendance_name,
			'attendance_contact_no' => $attendance_contact_no,
			'attendance_head' => $attendance_head,
			'status' => 'Active',
			'created_at' => date('Y-m-d H:i:s'),

		);
		header('Content-Type: application/json');
		echo json_encode($this->AttendanceModel->create_attendance($data));
	
	}




	// Function to Delete/Deactivate
	public function delete_attendance($time_out_id,$time_in_id)
	{
		$data = array(
			'status' => 'Inactive',
			'updated_at' => date('Y-m-d H:i:s'),

		);
		$this->AttendanceModel->delete_attendance($time_out_id,$time_in_id);
	}
}
