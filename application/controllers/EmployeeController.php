<?php
defined('BASEPATH') or exit('No direct script access allowed');

class EmployeeController extends CI_Controller
{


	public function __construct()
	{
		parent::__construct();
		!$this->session->userdata('TOKEN') && redirect(base_url());

		$this->load->database();

		$this->load->model('EmployeeModel');
	}


	public function employee_page()
	{
		$this->load->view('template/header');
		$this->load->view('template/sidebar');
		$this->load->view('pages/admin/employee_management/employee');
		$this->load->view('template/footer');
	}

	// Function to Get One
	public function get_one_employee($id)
	{
		echo json_encode($this->EmployeeModel->get_one_employee($id));
	}

	// Function to Get All
	public function get_all_employee()
	{
		echo json_encode($this->EmployeeModel->get_all_employee());
	}

	// Function to Create
	public function create_employee()
	{
		$config['upload_path'] = './assets/uploads/';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size']             = 100;
		$config['max_width']            = 6000; // 6000px you can set the value you want
		$config['max_height']           = 6000; // 6000px


        $this->load->library('phpqrcode/Qrlib');
		$this->load->library('upload', $config);
        $this->load->helper('url');

		if (!$this->upload->do_upload('photo')) {
			echo $this->upload->display_errors();
		} else {
			$photo_info = $this->upload->data();
			$photo_path = $photo_info['raw_name'] . $photo_info['file_ext'];
		}

		$employee_no = $this->EmployeeModel->generate_emp_no();
		$first_name = $this->input->post('first_name');
		$middle_name = $this->input->post('middle_name');
		$last_name = $this->input->post('last_name');
		$extension_name = $this->input->post('extension_name');
		$email = $this->input->post('email');
		$cellphone_no = $this->input->post('cellphone_no');
		$nationality = $this->input->post('nationality');
		$gender = $this->input->post('gender');
		$birth_date = $this->input->post('birth_date');
		$date_hired = $this->input->post('date_hired');
		$job_title_id = $this->input->post('job_title_id');
		$address = $this->input->post('address');
		$data = array(
			'photo' => $photo_path,
			'employee_no' => 'employee_'.$employee_no['random_num'],
			'first_name' => $first_name,
			'middle_name' => $middle_name,
			'last_name' => $last_name,
			'extension_name' => $extension_name,
			'email' => $email,
			'cellphone_no' => $cellphone_no,
			'nationality' => $nationality,
			'gender' => $gender,
			'birth_date' => $birth_date,
			'date_hired' => $date_hired,
			'job_title_id' => $job_title_id,
			'address' => $address,
			'status' => 'Active',
			'created_at' => date('Y-m-d H:i:s'),

		);

		// Generate QR Code
		$SERVERFILEPATH = './assets/uploads/';
		$text = $data['employee_no'];
		$text1 = substr($text, 0, 9);
		$folder = $SERVERFILEPATH;
		$file_name1 = $text1 . "-Qrcode" . rand(2, 200) . ".png";
		$file_name = $folder . $file_name1;
		QRcode::png($text, $file_name);
		echo "<center><img src=" . base_url('assets/uploads/') . $file_name1 . "></center";
		// $SERVERFILEPATH = './assets/uploads/';
		// $qr_text = "wewew";
		// $qr_text1 = substr($qr_text, 0, 9);
		// $uploads_folder = $SERVERFILEPATH;
		// $qr_file_name1 = $qr_text1 . "-Qrcode" . rand(2, 200) . ".png";
		// $qr_file_name = $uploads_folder . $qr_file_name1;
		// QRcode::png($qr_text, $qr_file_name);

		$this->EmployeeModel->create_employee($data);

	}


	// Function to Update
	public function update_employee($id)
	{
		$config['upload_path'] = './assets/uploads/';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size']             = 100;
		$config['max_width']            = 6000; // 6000px you can set the value you want
		$config['max_height']           = 6000; // 6000px


		$this->load->library('upload', $config);
		if (!$this->upload->do_upload('photo')) {
			echo $this->upload->display_errors();
		} else {
			$photo_info = $this->upload->data();
			$photo_path = $photo_info['raw_name'] . $photo_info['file_ext'];
		}

		$first_name = $this->input->post('first_name');
		$middle_name = $this->input->post('middle_name');
		$last_name = $this->input->post('last_name');
		$extension_name = $this->input->post('extension_name');
		$email = $this->input->post('email');
		$cellphone_no = $this->input->post('cellphone_no');
		$nationality = $this->input->post('nationality');
		$gender = $this->input->post('gender');
		$birth_date = $this->input->post('birth_date');
		$date_hired = $this->input->post('date_hired');
		$job_title_id = $this->input->post('job_title_id');
		$address = $this->input->post('address');

	

		$data = array(
			'first_name' => $first_name,
			'middle_name' => $middle_name,
			'last_name' => $last_name,
			'extension_name' => $extension_name,
			'email' => $email,
			'cellphone_no' => $cellphone_no,
			'nationality' => $nationality,
			'gender' => $gender,
			'birth_date' => $birth_date,
			'date_hired' => $date_hired,
			'job_title_id' => $job_title_id,
			'address' => $address,

			'status' => 'Active',
			'created_at' => date('Y-m-d H:i:s'),

		);

			if ($photo_path != "") {
			$data['photo'] = $photo_path;
			}


		$this->EmployeeModel->update_employee($id, $data);
	}


	// Function to Delete/Deactivate
	public function delete_employee($id)
	{
		$data = array(
			'status' => 'Inactive',
			'updated_at' => date('Y-m-d H:i:s'),

		);
		$this->EmployeeModel->delete_employee($id, $data);
	}
}


