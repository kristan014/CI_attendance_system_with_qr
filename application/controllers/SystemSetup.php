<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SystemSetup extends CI_Controller {


	public function dashboard() 
	{
		$this->load->view('template/header');
		$this->load->view('template/sidebar');
		$this->load->view('pages/dashboard');
		$this->load->view('template/footer');	
		
	}
}
