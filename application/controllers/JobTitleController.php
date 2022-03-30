<?php
defined('BASEPATH') or exit('No direct script access allowed');

class JobTitleController extends CI_Controller
{


	public function __construct()
	{
		parent::__construct();
		!$this->session->userdata('TOKEN') && redirect(base_url());

		$this->load->database();

		$this->load->model('JobTitleModel');
	}


	public function job_title_page()
	{
		$this->load->view('template/header');
		$this->load->view('template/sidebar');
		$this->load->view('pages/admin/employee_management/job_title');
		$this->load->view('template/footer');
	}

	// Function to Get One
	public function get_one_job_title($id)
	{
		echo json_encode($this->JobTitleModel->get_one_job_title($id));
	}

	// Function to Get All
	public function get_all_job_title()
	{
		echo json_encode($this->JobTitleModel->get_all_job_title());
	}

	// Function to Create
	public function create_job_title()
	{
		$job_title_name = $this->input->post('job_title_name');
		$job_title_description = $this->input->post('job_title_description');
		$department_id = $this->input->post('department_id');

		$data = array(
			'job_title_name' => $job_title_name,
			'job_title_description' => $job_title_description,
			'department_id' => $department_id,
			'status' => 'Active',
			'created_at' => date('Y-m-d H:i:s'),

		);

		$this->JobTitleModel->create_job_title($data);


		// echo json_encode(array(
		// 	"statusCode"=>200
		// ));
	}


	// Function to Update
	public function update_job_title($id)
	{
		$job_title_name = $this->input->post('job_title_name');
		$job_title_description = $this->input->post('job_title_description');
		$department_id = $this->input->post('department_id');

		$data = array(
			'job_title_name' => $job_title_name,
			'job_title_description' => $job_title_description,
			'department_id' => $department_id,
			'updated_at' => date('Y-m-d H:i:s'),

		);

		$this->JobTitleModel->update_job_title($id,$data);

	}


	// Function to Delete/Deactivate
	public function delete_job_title($id)
	{
		$data = array(
			'status' => 'Inactive',
			'updated_at' => date('Y-m-d H:i:s'),

		);
		$this->JobTitleModel->delete_job_title($id,$data);
	}
}
