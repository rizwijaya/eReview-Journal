<?php
defined('BASEPATH') or exit('No direct script access allowed');

class MakelaarCtl extends CI_Controller
{

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		if (!$this->session->userdata('logged_in')) {
			redirect('welcome/index');
		}

		$session_data = $this->session->userdata('logged_in');

		if ($session_data['nama_grup'] != 'makelar') {
			redirect('welcome/redirecting');
		}
		$this->load->view('common/header_makelar', array(
			"nama_user" => $session_data['namalengkap'],
			"current_role" => $session_data['nama_grup']
		));
		$this->load->view('common/topmenu');
		$this->load->view('common/content');
		$this->load->view('common/footer');
	}

	public function getViewallTask()
	{
		if (!$this->session->userdata('logged_in')) {
			redirect('welcome/index');
		}

		$session_data = $this->session->userdata('logged_in');

		if ($session_data['nama_grup'] != 'makelar') {
			redirect('welcome/redirecting');
		}

		$this->load->model(array("task"));
		$tasks = $this->task->getviewallmakelar();

		$this->load->view('common/header_makelar', array(
			"nama_user" => $session_data['namalengkap'],
			"current_role" => $session_data['nama_grup']
		));

		$this->load->view('makelaar/viewallTask', array("tasks" => $tasks));
		//$this->load->view('common/content');
		$this->load->view('common/footer');
	}
	public function getViewOnGoingTask()
	{
		if (!$this->session->userdata('logged_in')) {
			redirect('welcome/index');
		}

		$session_data = $this->session->userdata('logged_in');

		if ($session_data['nama_grup'] != 'makelar') {
			redirect('welcome/redirecting');
		}

		$this->load->model(array("task"));
		$status = 2;
		$tasks = $this->task->getviewongoing($status);

		$this->load->view('common/header_makelar', array(
			"nama_user" => $session_data['namalengkap'],
			"current_role" => $session_data['nama_grup']
		));

		$this->load->view('makelaar/viewOnGoing', array("tasks" => $tasks));
		//$this->load->view('common/content');
		$this->load->view('common/footer');
	}
	public function getViewCompletedTask()
	{
		if (!$this->session->userdata('logged_in')) {
			redirect('welcome/index');
		}

		$session_data = $this->session->userdata('logged_in');

		if ($session_data['nama_grup'] != 'makelar') {
			redirect('welcome/redirecting');
		}

		$this->load->model(array("task"));
		$status = 5;
		$tasks = $this->task->getviewcompleted($status);

		$this->load->view('common/header_makelar', array(
			"nama_user" => $session_data['namalengkap'],
			"current_role" => $session_data['nama_grup']
		));

		$this->load->view('makelaar/viewCompletedTask', array("tasks" => $tasks, "msg" => ""));
		//$this->load->view('common/content');
		$this->load->view('common/footer');
	}

	public function confirmPayment($id_task, $id_assign, $id_user)
	{
		if (!$this->session->userdata('logged_in')) {
			redirect('welcome/index');
		}

		$session_data = $this->session->userdata('logged_in');

		if ($session_data['nama_grup'] != 'makelar') {
			redirect('welcome/redirecting');
		}

		$this->load->model(array("Payment"));
		$this->load->model(array("task"));
		$saldo = $this->Payment->getSaldo($id_user);
		$amounttambah = $this->Payment->getAmountComplete($id_assign);
		$amount = $saldo + $amounttambah;
		$status = 6;
		$this->Payment->confirmPayment($status, $id_user, $amount, $id_assign);

		$this->load->view('common/header_makelar', array(
			"nama_user" => $session_data['namalengkap'],
			"current_role" => $session_data['nama_grup']
		));
		$status = 5;
		$tasks = $this->task->getviewcompleted($status);
		$msg = "<div class='alert alert-success' role='alert'>Thank you for confirmed this task, 
		So the Editor will get the articles and the Reviewer can receive the credits.</div>";
		$this->load->view('makelaar/viewCompletedTask', array("tasks" => $tasks, "msg" => $msg));
		$this->load->view('common/footer');
	}
}
