<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SystemSetup extends CI_Controller {


	public function start_page() 
	{
		$this->load->view('template/header');
		$this->load->view('template/sidebar');
		$this->load->view('template/body');
		$this->load->view('template/footer');
	}
}
