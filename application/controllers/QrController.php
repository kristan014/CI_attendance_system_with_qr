<?php
defined('BASEPATH') or exit('No direct script access allowed');
class QrController extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        !$this->session->userdata('TOKEN') && redirect(base_url());
        

        $this->load->library('phpqrcode/Qrlib');
        $this->load->helper('url');
    }


    public function attendance_scanner()
    {
        $this->load->view('template/header');
		$this->load->view('template/sidebar');
        $this->load->view('pages/attendance_clerk/attendance_scanner');
		$this->load->view('template/footer');

    }


    public function qrcodeGenerator()
    {
        $qrtext = $this->input->post('qrcode_text');
        if (isset($qrtext)) {
            //file path for store images
            $SERVERFILEPATH = './assets/uploads/';
            $text = $qrtext;
            $text1 = substr($text, 0, 9);
            $folder = $SERVERFILEPATH;
            $file_name1 = $text1 . "-Qrcode" . rand(2, 200) . ".png";
            $file_name = $folder . $file_name1;
            QRcode::png($text, $file_name);
            echo "<center><img src=" . base_url('assets/uploads/') . $file_name1 . "></center";
        } else {
            echo "No Text Entered";
        }
    }
}
