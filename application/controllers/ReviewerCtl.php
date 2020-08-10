<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ReviewerCtl extends CI_Controller
{

	public function index()
	{
		if (!$this->session->userdata('logged_in')) {
			redirect('welcome/index');
			return;
		}
		$session_data = $this->session->userdata('logged_in');
		if ($session_data['nama_grup'] != 'reviewer') {
			redirect('welcome/redirecting');
		}

		$this->load->model(array('reviewer'));
		$saldo = $this->reviewer->getBalance($session_data['id_user']);
		$this->load->view('common/header_reviewer', array(
			"nama_user" => $session_data['namalengkap'],
			"current_role" => $session_data['nama_grup'],
			"saldo" => $saldo
		));
		$this->load->view('common/topmenu');
		$this->load->view('common/content');
		$this->load->view('common/footer');
	}

	public function taskrequest()
	{
		if (!$this->session->userdata('logged_in')) {
			redirect('welcome/index');
		}
		$session_data = $this->session->userdata('logged_in');

		if ($session_data['nama_grup'] != 'reviewer') {
			redirect('welcome/redirecting');
		}

		$this->load->model(array("reviewer"));
		//ambil task yang punya saya
		$status = 1;
		$tasks = $this->reviewer->getRequest($status, $session_data['id_user']);
		$saldo = $this->reviewer->getBalance($session_data['id_user']);
		$this->load->view('common/header_reviewer', array(
			"nama_user" => $session_data['namalengkap'],
			"current_role" => $session_data['nama_grup'],
			"saldo" => $saldo
		));
		$this->load->view('reviewer/taskrequest', array("tasks" => $tasks));
		//$this->load->view('common/content');
		$this->load->view('common/footer');
	}

	public function accepted($id_task = null)
	{
		$this->load->helper('date');
		//if(!isset($id_Task)) redirect('')
		$this->load->model("task");
		$date = date('Y-m-d', now());
		$page = $this->task->getTaskPage($id_task);
		$deadline = date('Y-m-d', strtotime($date . '+' . $page->page . ' days'));
		$this->db->set('tgl_deadline', $deadline);
		$this->db->where('id_task', $id_task);
		$this->db->update('assignment');

		$status = 2;
		$this->db->set('status', $status);
		$this->db->where('id_task', $id_task);
		$this->db->update('assignment');
		redirect('reviewerCtl/taskrequest');
	}

	public function rejected($id_task = null)
	{
		$status = 3;
		$this->db->set('status', $status);
		$this->db->where('id_task', $id_task);
		$this->db->update('assignment');
		redirect('reviewerCtl/taskrequest');
	}

	public function viewTask()
	{
		if (!$this->session->userdata('logged_in')) {
			redirect('welcome/index');
		}
		$session_data = $this->session->userdata('logged_in');

		if ($session_data['nama_grup'] != 'reviewer') {
			redirect('welcome/redirecting');
		}

		$this->load->model(array("reviewer"));
		//ambil task yang punya saya
		$status = 2;
		$tasks = $this->reviewer->getviewreviewer($status, $session_data['id_user']);
		$saldo = $this->reviewer->getBalance($session_data['id_user']);
		$this->load->view('common/header_reviewer', array(
			"nama_user" => $session_data['namalengkap'],
			"current_role" => $session_data['nama_grup'],
			"saldo" => $saldo
		));

		$this->load->view('reviewer/view_task', array("tasks" => $tasks, "msg" => ""));
		$this->load->view('common/footer');
	}

	public function completeReviewTask($id_assign)
	{

		//Untuk memberikan tugas yg sudah complete kepada Editor
		//Dan mengubah status Task menjadi (4) yaitu Waiting Payment
		if (!$this->session->userdata('logged_in')) {
			redirect('welcome/index');
		}
		$session_data = $this->session->userdata('logged_in');

		if ($session_data['nama_grup'] != 'reviewer') {
			redirect('welcome/redirecting');
		}
		$this->load->model(array('reviewer'));
		$this->load->model(array("task"));
		//ambil task yang punya saya

		$tasks = $this->task->getviewcompletereviewer($id_assign, $session_data['id_user']);

		$saldo = $this->reviewer->getBalance($session_data['id_user']);
		$this->load->view('common/header_reviewer', array(
			"nama_user" => $session_data['namalengkap'],
			"current_role" => $session_data['nama_grup'],
			"saldo" => $saldo
		));
		$namareviewer = $session_data['namalengkap'];
		$this->load->view('reviewer/completeTask', array(
			"tasks" => $tasks,
			"namareviewer" => $namareviewer,
			"id_assign" => $id_assign, "error" => ""
		));
		$this->load->view('common/footer');
	}

	public function completingReviewTask($id_assign)
	{

		//Untuk membrikan tugas yg sudah complete kepada Editor
		//Dan mengubah status Task menjadi (4) yaitu Waiting Payment
		if (!$this->session->userdata('logged_in')) {
			redirect('welcome/index');
		}
		$session_data = $this->session->userdata('logged_in');

		if ($session_data['nama_grup'] != 'reviewer') {
			redirect('welcome/redirecting');
		}

		$this->load->helper(array('form', 'url', 'security'));
		$this->load->model('task');
		$this->load->model(array("reviewer"));
		$this->load->library(array('form_validation'));

		$config['upload_path']          = './berkas/complete';
		$config['allowed_types']        = 'doc|docx|pdf';
		$config['max_size']             = 2048;
		//		$config['max_width']            = 150;
		//		$config['max_height']           = 200;

		$new_name = $_FILES["userfile"]['name'];
		$new_name = str_replace(" ", "_", $new_name);
		$config['file_name'] = $new_name;

		$this->load->library('upload', $config);
		if (!$this->upload->do_upload('userfile')) {   //gagal upload
			$msg = $this->upload->display_errors();
			//ambil task yang punya saya

			$tasks = $this->task->getviewcompletereviewer($id_assign, $session_data['id_user']);

			$saldo = $this->reviewer->getBalance($session_data['id_user']);
			$this->load->view('common/header_reviewer', array(
				"nama_user" => $session_data['namalengkap'],
				"current_role" => $session_data['nama_grup'],
				"saldo" => $saldo
			));
			$namareviewer = $session_data['namalengkap'];
			$this->load->view('reviewer/completeTask', array(
				"tasks" => $tasks,
				"namareviewer" => $namareviewer,
				"id_assign" => $id_assign, "error" => "$msg"
			));
			$this->load->view('common/footer');
		}
		$data = array('upload_data' => $this->upload->data());
		//ambil task yang punya saya
		$status = 4;
		$tasks = $this->task->insertcompleteTask($id_assign, $status, $session_data['id_user'], $new_name);
		$saldo = $this->reviewer->getBalance($session_data['id_user']);
		$this->load->view('common/header_reviewer', array(
			"nama_user" => $session_data['namalengkap'],
			"current_role" => $session_data['nama_grup'],
			"saldo" => $saldo
		));
		$status = 2;
		$tasks = $this->reviewer->getviewreviewer($status, $session_data['id_user']);
		$msg = '<div class="alert alert-success" role="alert">Hooray! Your job is done, please wait for receive your credits. </div>';
		$this->load->view('reviewer/view_task', array("msg" => $msg, "tasks" => $tasks));
		$this->load->view('common/footer');
	}

	public function deductFund()
	{
		if (!$this->session->userdata('logged_in')) {
			redirect('welcome/index');
		}
		$session_data = $this->session->userdata('logged_in');

		if ($session_data['nama_grup'] != 'reviewer') {
			redirect('welcome/redirecting');
		}

		$this->load->model(array('reviewer'));
		$saldo = $this->reviewer->getBalance($session_data['id_user']);
		$this->load->view('common/header_reviewer', array(
			"nama_user" => $session_data['namalengkap'],
			"current_role" => $session_data['nama_grup'],
			"saldo" => $saldo
		));
		$this->load->view('reviewer/deduct_fund', array(
			"saldo" => $saldo,
			"username" => $session_data['username'],
			"msg" => ""
		));
		$this->load->view('common/footer');
	}

	public function deductFunding()
	{
		if (!$this->session->userdata('logged_in')) {
			redirect('welcome/index');
		}
		$session_data = $this->session->userdata('logged_in');

		if ($session_data['nama_grup'] != 'reviewer') {
			redirect('welcome/redirecting');
		}
		$this->load->model(array('reviewer'));
		$this->load->helper(array('form', 'url', 'security'));
		$this->load->library(array('form_validation'));
		$saldo = $this->reviewer->getSaldo($session_data['id_user']);

		$this->form_validation->set_rules(
			'potongansaldo',
			'Deduct Fund Credits',
			'trim|min_length[2]|max_length[128]|xss_clean'
		);

		$potongansaldo = $this->input->post('potongansaldo');
		if ($saldo >= $potongansaldo) {
			$jumlahsaldo = $saldo - $potongansaldo;
			$this->reviewer->jumlahSaldo($jumlahsaldo, $session_data['id_user']);

			$this->load->model(array('reviewer'));
			$saldo = $this->reviewer->getBalance($session_data['id_user']);
			$this->load->view('common/header_reviewer', array(
				"nama_user" => $session_data['namalengkap'],
				"current_role" => $session_data['nama_grup'],
				"saldo" => $saldo
			));
			$msg = '<div class="alert alert-success" 
			role="alert">Transfer Success! Your money has been transfered to your Bank Account.</div>';
			$this->load->view('reviewer/deduct_fund', array(
				"saldo" => $saldo,
				"username" => $session_data['username'],
				"msg" => $msg
			));
			$this->load->view('common/footer');
		} else {
			$this->load->model(array('reviewer'));
			$saldo = $this->reviewer->getBalance($session_data['id_user']);
			$this->load->view('common/header_reviewer', array(
				"nama_user" => $session_data['namalengkap'],
				"current_role" => $session_data['nama_grup'],
				"saldo" => $saldo
			));
			$msg = '<div class="alert alert-danger" role="alert">
			Transfer Failed. Your requested is over than your credits!</div>';
			$this->load->view('reviewer/deduct_fund', array(
				"saldo" => $saldo,
				"username" => $session_data['username'],
				"msg" => $msg
			));
			$this->load->view('common/footer');
		}

		$this->load->view('common/header_reviewer', array(
			"nama_user" => $session_data['namalengkap'],
			"current_role" => $session_data['nama_grup'],
			"saldo" => $saldo
		));
	}
}
