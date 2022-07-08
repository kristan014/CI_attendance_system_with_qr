<?php
defined('BASEPATH') or exit('No direct script access allowed');

class TimeOutController extends CI_Controller
{


	public function __construct()
	{
		parent::__construct();
		!$this->session->userdata('TOKEN') && redirect(base_url());

		$this->load->database();

		$this->load->model('TimeOutModel');
	}

    public function time_out_page()
    {
        $this->load->view('template/header');
		$this->load->view('template/sidebar');
        $this->load->view('pages/attendance_clerk/time_out');
		$this->load->view('template/footer');

    }



	// // Function to Get One
	// public function get_one_time_out($id)
	// {
	// 	echo json_encode($this->TimeOutModel->get_one_time_out($id));
	// }

	// // Function to Get All
	// public function get_all_time_out()
	// {
	// 	echo json_encode($this->TimeOutModel->get_all_time_out());
	// }

	// // Function to Create
	// public function create_time_out()
	// {

	// 	$employee_id = $this->input->post('employee_id');

	// 	$data = array(
	// 		'employee_id' => $employee_id,
	// 	);
		
	// 	header('Content-Type: application/json');
	// 	echo json_encode($this->TimeOutModel->create_time_out($data));
	// }


	
}
