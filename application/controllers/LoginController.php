<?php
defined('BASEPATH') or exit('No direct script access allowed');

class LoginController extends CI_Controller
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

		if ($this->form_validation->run()) {
			$email = $this->input->post('email');
			$password = $this->input->post('password');

			if ($this->UserModel->login($email, $password)) {
				$session_data = array(
					'email'     =>     $email
				);
				$this->session->set_userdata($session_data);
				redirect(base_url() . 'SystemSetup/dashboard');
			}else{
				$this->session->set_flashdata('error', 'Invalid Username or Password');  
				redirect(base_url());

			}
		} else {
			$this->login();
		}
	}


	public function password_reset()
	{
		// $this->session->userdata('TOKEN') && redirect('SystemSetup/dashboard');
		// $this->load->view('access/password-reset');
	}

	public function logout()
	{
		$this->session->sess_destroy();
		redirect('Access/login');
	}
}
