<?php
defined('BASEPATH') or exit('No direct script access allowed');

class AccessController extends CI_Controller
{


	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		//Load the Model here 
		$this->load->model('UserModel');
		
	}

	public function login()
	{

		$this->load->view('access/login');
	}

	public function form_validation()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('email', 'Email', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');
		$token = openssl_random_pseudo_bytes(16);
		$token = bin2hex($token);

		if ($this->form_validation->run()) {
			$email = $this->input->post('email');
			$password = $this->input->post('password');

			if ($this->UserModel->login($email, $password)) {
				$user =  $this->UserModel->login($email, $password);
				$user_details =  $this->UserModel->for_session_details($user['user_id']);

				$session_data = array(
					'EMAIL'     =>     $email,
					'TOKEN'     =>     $token,
					'USERID' => $user['user_id'],
					'DEPARTMENT_NAME' =>$user_details[0]->department_name,
					'JOB_TITLE' => $user_details[0]->job_title_name,
					'FIRSTNAME' => $user_details[0]->first_name,
					'LASTNAME' => $user_details[0]->last_name,
					'EMPLOYEEID' => $user_details[0]->employee_id,


				);
				$this->session->set_userdata($session_data);
			

				redirect(base_url('SystemSetup/dashboard'));
			}else{
				$this->session->set_flashdata('error', 'Invalid Username or Password');  
		
				redirect(base_url());

			}
		} else {
			$this->login();
		}
	}


	

	public function logout()
	{
		$this->session->sess_destroy();
		redirect(base_url());
	}
}
