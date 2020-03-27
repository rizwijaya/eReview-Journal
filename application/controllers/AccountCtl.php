<?php
defined('BASEPATH') or exit('No direct script access allowed');

//session_start();
class AccountCtl extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model(array('Account'));
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->library('session');
	}
	//show page all
	public function index()
	{
		/*if($this->->is_logged_in()) //jika session sudah terdaftar
            {
                redirect("dasboard");
            }else{ */
		$this->load->view('Beranda');
	}
	public function login($pesan = '')
	{
		$this->load->view('login', array('msg' => $pesan));
	}
	public function createaccount($pesan = '')
	{
		$this->load->view('createaccount', array('msg' => $pesan));
	}

	//user authentication
	//validate user_registration_form
	public function creatingAccount()
	{

		$this->form_validation->set_rules(
			'nama',
			'Nama',
			'trim|min_length[2]|max_length[250]|xss_clean'
		);
		$this->form_validation->set_rules(
			'username',
			'Username',
			'trim|min_length[2]|max_length[128]|xss_clean'
		);
		$this->form_validation->set_rules(
			'email',
			'Email',
			'trim|min_length[2]|max_length[256]|xss_clean'
		);
		$this->form_validation->set_rules(
			'password',
			'Password',
			'trim|min_length[2]|max_length[128]|xss_clean'
		);

		$res = $this->form_validation->run();
		if ($res == FALSE) {
			$msg = validation_errors();
			$this->load->view('createaccount', array('msg' => $msg));
			return FALSE;
		}

		$id_user = $this->Account->insertNewUser();
		redirect('accountCtl/login' . $id_user);
	}

	//check user login
	public function checkingLogin()
	{

		$this->form_validation->set_rules(
			'username',
			'username',
			'trim|min_length[2]|max_length[128]|xss_clean'
		);
		$this->form_validation->set_rules(
			'password',
			'password',
			'trim|min_length[2]|max_length[128]|xss_clean'
		);

		$res = $this->form_validation->run();
		if ($res == FALSE) {
			$msg = validation_errors();
			$this->load->view('login', array('msg' => $msg));
			return FALSE;
		}
		$id_user = $this->Account->getIdUser();

		if ($id_user == -1) {
			$this->load->view('login', array('msg' => 'Username/Password Invalid'));
		} else {
			$peran = $this->Account->getPeranUser($id_user);
			if ($peran == 1) {
				redirect('editorCtl/index/');
			} else if ($peran == 2) {
				redirect('reviewerCtl/index/');
			} else {
				redirect('makelarCtl/index/');
				//redirect('makelarCtl/index/' . $id_user);
			}
		}
	}
}
