<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SystemSetup extends CI_Controller {


	public function __construct()
	{
		parent::__construct();
		$this->load->database();

		//Load the Model here 
		$this->load->model('UserModel');
	}


    public function employee_page()
	{

	}

    public function get_one_employee()
	{

	}


    public function get_all_employee()
	{

	}


    public function update_employee()
	{

	}


    
    public function delete_employee()
	{

	}
}
