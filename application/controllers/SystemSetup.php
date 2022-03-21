<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SystemSetup extends CI_Controller {
	function __construct() {
		parent::__construct();
		
		!$this->session->userdata('TOKEN') && redirect(base_url());
	} 

	public function dashboard() 
	{
		$this->load->view('template/header');
		$this->load->view('template/sidebar');
		$this->load->view('pages/dashboard');
		$this->load->view('template/footer');	
		
		// print_r($this->session->userdata('DEPARTMENT_NAME'));
	}
}
