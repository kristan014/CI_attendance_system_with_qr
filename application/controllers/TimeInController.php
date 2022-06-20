<?php
defined('BASEPATH') or exit('No direct script access allowed');

class TimeInController extends CI_Controller
{


	public function __construct()
	{
		parent::__construct();
		!$this->session->userdata('TOKEN') && redirect(base_url());

		$this->load->database();

		$this->load->model('TimeInModel');
	}

    public function time_in_page()
    {
        $this->load->view('template/header');
		$this->load->view('template/sidebar');
        $this->load->view('pages/attendance_clerk/time_in');
		$this->load->view('template/footer');

    }



	// Function to Get One
	public function get_one_time_in($id)
	{
		echo json_encode($this->TimeInModel->get_one_time_in($id));
	}

	// Function to Get All
	public function get_all_time_in()
	{
		echo json_encode($this->TimeInModel->get_all_time_in());
	}

	// Function to Create
	public function create_time_in()
	{

		$employee_id = $this->input->post('employee_id');

		$data = array(
			'employee_id' => $employee_id,
		);
		
		header('Content-Type: application/json');
		echo json_encode($this->TimeInModel->create_time_in($data));
	}



}
