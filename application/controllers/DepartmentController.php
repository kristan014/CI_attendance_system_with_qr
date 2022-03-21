<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DepartmentController extends CI_Controller {


	public function __construct()
	{
		parent::__construct();
		!$this->session->userdata('TOKEN') && redirect(base_url());

		$this->load->database();

		$this->load->model('UserModel');
	}


    public function department_page()
	{
		$this->load->view('template/header');
		$this->load->view('template/sidebar');
		$this->load->view('pages/department');
		$this->load->view('template/footer');	
	}

    public function get_one_department()
	{

	}


    public function get_all_department()
	{

	}


    public function update_department()
	{

	}


    
    public function delete_department()
	{

	}
}
