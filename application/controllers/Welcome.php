<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Welcome extends CI_Controller
{
	public function index()
	{
		if ($this->session->userdata('logged_in')) {
			redirect('welcome/redirecting');
			return;
		}
		$this->load->view('common/header');
		$this->load->view('common/topmenu');
		$this->load->view('common/content');
		$this->load->view('common/footer');
	}

	public function login($msg = '')
	{
		$this->load->view('common/header');
		//		$this->load->view('common/topmenu');
		$this->load->view(
			'login',
			array('msg' => $msg)
		);
		$this->load->view('common/footer');
	}


	public function redirecting()
	{

		if (!$this->session->userdata('logged_in')) {
			redirect('welcome/index');
		}
		$session_data = $this->session->userdata('logged_in');

		switch ($session_data['id_grup']) {
			case 1:
				redirect('editorCtl');
				break;
			case 2:
				redirect('reviewerCtl');
				break;
			case 3:
				redirect('makelaarCtl');
				break;
			default:
				redirect('welcome');
				break;
		}

		return;
	}

	public function signup($msg = '')
	{
		$this->load->helper(array('form', 'url'));
		$this->load->view('common/header');
		$this->load->view('signup', array("msg" => $msg));
		$this->load->view('common/footer');
		return;
	}
}
