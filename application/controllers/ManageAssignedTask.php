<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ManageAssignedTask extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Task');
		$this->load->model('Reviewer');
		$this->load->model('Payment');
	}
	public function index()
	{
		echo "<h1>Selamat datang di Manage Assigned Task!</h1>";
		echo "<a href='http://localhost/ereview/index.php/manageAssignedTask/acceptTask'>Accept Task</a><br>";
		echo "<a href='http://localhost/ereview/index.php/manageAssignedTask/rejectTask'>Reject Task</a><br>";
		echo "<a href='http://localhost/ereview/index.php/manageAssignedTask/deductFunds'>Deduct Funds</a><br>";
	}
	public function AcceptTask()
	{
		$this->load->view('reviewer/AcceptTask');
	}
	public function rejectTask()
	{
		$this->load->view('reviewer/RejectTask');
	}
	public function submitReview()
	{

		$this->load->view('reviewer/SubmitReview');
	}
	public function deductFunds()
	{
		$this->load->view('reviewer/DeductFunds');
	}
}
