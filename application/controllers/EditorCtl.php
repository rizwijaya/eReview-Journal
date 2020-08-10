<?php
defined('BASEPATH') or exit('No direct script access allowed');

class EditorCtl extends CI_Controller
{
	public function index()
	{
		if (!$this->session->userdata('logged_in')) {
			redirect('welcome/index');
		}
		$session_data = $this->session->userdata('logged_in');

		if ($session_data['nama_grup'] != 'editor') {
			redirect('welcome/redirecting');
		}

		$this->load->view('common/header_editor', array(
			"nama_user" => $session_data['namalengkap'],
			"current_role" => $session_data['nama_grup']
		));
		$this->load->view('common/topmenu');
		$this->load->view('common/content');
		$this->load->view('common/footer');
	}

	public function viewTask()
	{
		if (!$this->session->userdata('logged_in')) {
			redirect('welcome/index');
		}
		$session_data = $this->session->userdata('logged_in');

		if ($session_data['nama_grup'] != 'editor') {
			redirect('welcome/redirecting');
		}

		$this->load->model(array("task"));
		//ambil task yang punya saya
		$tasks = $this->task->getMyTask($session_data['id_user']);

		$this->load->view('common/header_editor', array(
			"nama_user" => $session_data['namalengkap'],
			"current_role" => $session_data['nama_grup']
		));
		$this->load->view('editor/view_task', array(
			"tasks" => $tasks,
			"msg" => ""
		));
		$this->load->view('common/footer');
	}

	public function addTask() 	//Fungsi menampilkan halaman task
	{
		if (!$this->session->userdata('logged_in')) {
			redirect('welcome/index');
		}
		$session_data = $this->session->userdata('logged_in');

		if ($session_data['nama_grup'] != 'editor') {
			redirect('welcome/redirecting');
		}

		$this->load->helper(array('form', 'url'));

		$this->load->view('common/header_editor', array(
			"nama_user" => $session_data['namalengkap'],
			"current_role" => $session_data['nama_grup']
		));
		$this->load->view('editor/add_task', array("error" => ""));
		$this->load->view('common/footer');
	}

	public function addingTask()	//Menambahkan task
	{
		if (!$this->session->userdata('logged_in')) {
			redirect('welcome/index');
		}
		$session_data = $this->session->userdata('logged_in');

		if ($session_data['nama_grup'] != 'editor') {
			redirect('welcome/redirecting');
		}

		$this->load->helper(array('form', 'url', 'security'));
		$this->load->model('task');
		$this->load->library(array('form_validation'));

		$this->form_validation->set_rules(
			'judul',
			'Title',
			'trim|min_length[2]|max_length[128]|xss_clean'
		);
		$this->form_validation->set_rules(
			'keywords',
			'Keywords',
			'trim|min_length[2]|max_length[128]|xss_clean'
		);
		$this->form_validation->set_rules(
			'authors',
			'Authors',
			'trim|min_length[2]|max_length[128]|xss_clean'
		);

		$res = $this->form_validation->run();
		if ($res == FALSE) {
			$msg = validation_errors();
			$this->load->view('common/header_editor', array(
				"nama_user" => $session_data['namalengkap'],
				"current_role" => $session_data['nama_grup']
			));
			$this->load->view('editor/add_task', $msg);
			$this->load->view('common/footer');
			return FALSE;
		}

		$config['upload_path']          = './berkas';
		$config['allowed_types']        = 'doc|docx|pdf';
		$config['max_size']             = 2048;
		//		$config['max_width']            = 150;
		//		$config['max_height']           = 200;

		$new_name = time() . '_' . $_FILES["userfile"]['name'];
		$new_name = str_replace(" ", "_", $new_name);
		$config['file_name'] = $new_name;

		$this->load->library('upload', $config);
		if (!$this->upload->do_upload('userfile')) {   //gagal upload
			$msg = array('error' => $this->upload->display_errors());
			$this->load->view('common/header_editor', array(
				"nama_user" => $session_data['namalengkap'],
				"current_role" => $session_data['nama_grup']
			));
			$this->load->view('common/topmenu');
			$this->load->view('editor/add_task', $msg);
			$this->load->view('common/footer');
			return;
		}
		//berhasil upload
		$data = array('upload_data' => $this->upload->data());
		//tambahkan data ke database
		$id_task = $this->task->insertNewTask($session_data['id_user'], $new_name);
		//Menghitung harga
		$page = $this->input->post('page');
		$price = $page * 10000;
		$this->task->insertprice($price, $page);
		//tampilkan halaman sukses
		$this->load->view('common/header_editor', array(
			"nama_user" => $session_data['namalengkap'],
			"current_role" => $session_data['nama_grup']
		));
		$this->selectPotentialReviewer($id_task);
		return;
	}

	public function selectPotentialReviewer($id_task = -1)	//Menampilkan halaman Select Potential
	{
		if (!$this->session->userdata('logged_in')) {
			redirect('welcome/index');
		}
		$session_data = $this->session->userdata('logged_in');

		if ($session_data['nama_grup'] != 'editor') {
			redirect('welcome/redirecting');
		}
		$this->load->helper('form_helper');
		$this->load->model(array('Task', 'Reviewer'));
		$thetask = $this->Task->getTheTask($id_task);
		$reviewers = $this->Reviewer->getAllReviewers();
		$this->load->view('common/header_editor', array(
			"nama_user" => $session_data['namalengkap'],
			"current_role" => $session_data['nama_grup']
		));
		$this->load->view(
			'editor/SelectPotentialReviewer',
			array(
				'task' => $thetask[0],
				'reviewers' => $reviewers
			)
		);
		$this->load->view('common/footer');
	}
	public function addingPotential()				//Menambahkan reviewer
	{
		if (!$this->session->userdata('logged_in')) {
			redirect('welcome/index');
		}
		$session_data = $this->session->userdata('logged_in');

		if ($session_data['nama_grup'] != 'editor') {
			redirect('welcome/redirecting');
		}
		$this->load->helper(array('form', 'url', 'security'));
		$this->load->model('Reviewer');
		//tambahkan data ke database
		$this->Reviewer->getPotential();
		//tampilkan halaman sukses
		$this->load->model(array("task"));
		//ambil task yang punya saya
		$tasks = $this->task->getMyTask($session_data['id_user']);

		$this->load->view('common/header_editor', array(
			"nama_user" => $session_data['namalengkap'],
			"current_role" => $session_data['nama_grup']
		));
		$msg = '<div class="alert alert-success" role="alert">Make an assingment to your reviewer Success! Please wait for the confirmation about your task.</div>';
		$this->load->view('editor/view_task', array("msg" => $msg, "tasks" => $tasks));
		$this->load->view('common/footer');
	}
}
