<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class LoginController extends CI_Controller {


	public function __construct(){
		parent::__construct();
		$this->load->database();

		//Load the Model here 
		$this->load->model('UserModel');   

}
	
	public function login()
	{
	
			$this->load->view('access/login');
		
	}

	public function oAuthForLogin() // !
	{
		$data = [
			'email' => $this->input->post('email'),
			'password' => $this->input->post('password'),

		];

		$get_user = $this->UserModel->get_user();		
		foreach($get_user as $row){
			if($row->email == $data['email'] && $row->password == $data['password']){
				echo "true";
			}
			else{
				echo "false";

			}
		}
	} 


	public function passwordReset()
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
