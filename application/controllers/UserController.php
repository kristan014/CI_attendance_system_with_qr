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

}
