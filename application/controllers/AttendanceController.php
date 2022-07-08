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
	public function get_one_attendance($id)
	{
		echo json_encode($this->AttendanceModel->get_one_attendance($id));
	}

	// Function to Get All
	public function get_all_attendance()
	{
		echo json_encode($this->AttendanceModel->get_all_attendance());
	}

	// Function to Create
	public function create_time_in()
	{

		$employee_id = $this->input->post('employee_id');
		$time_in = date('h:i');


		$data = array(
			'employee_id' => $employee_id,
			'time_in' => $time_in,

		);
		
		header('Content-Type: application/json');
		echo json_encode($this->AttendanceModel->create_time_in($data));
	}

    	// Function to Create
	public function create_time_out()
	{

		$employee_id = $this->input->post('employee_id');
		$time_out = date('h:i');


		$data = array(
			'time_out' => $time_out,
			'employee_id' => $employee_id,
		);
		
		header('Content-Type: application/json');
		echo json_encode($this->AttendanceModel->create_time_in($data));
	}



}
