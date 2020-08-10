<?php
defined('BASEPATH') or exit('No direct script access allowed');

class AccountCtl extends CI_Controller
{

	public function checkingLogin()
	{
		$this->load->helper(array('url', 'security'));
		$this->load->model('account');
		$this->load->library(array('form_validation'));

		$this->form_validation->set_rules(
			'username',
			'Username',
			'trim|min_length[2]|max_length[128]|xss_clean'
		);
		$this->form_validation->set_rules(
			'katasandi',
			'Kata Sandi',
			'trim|min_length[2]|max_length[128]|xss_clean'
		);

		$res = $this->form_validation->run();
		if ($res == FALSE) {
			$msg = validation_errors();
			$this->load->view(
				'login',
				array('msg' => $msg)
			);
			return FALSE;
		}
		$users = $this->account->getIDUser();


		if (sizeof($users) <= 0) {

			//kembali ke halaman login
			$this->load->view('common/header');
			//		$this->load->view('common/topmenu');
			$this->load->view(
				'login',
				array('msg' => '<div class="alert alert-danger" role="alert">Username/Password is incorrect!</div>')
			);
			$this->load->view('common/footer');
		} else {

			//inisialisasi session
			$sess_array = array(
				'id_user' => $users[0]['id_user'],
				'namalengkap' => $users[0]['nama'],
				'username' => $users[0]['username'],
				'id_grup' => $users[0]['id_grup'],
				'nama_grup' => $users[0]['nama_grup'],
				'currentgrup' => $users[0]['id_grup'],
				'password'   => $users[0]['password']
			);
			$this->session->set_userdata('logged_in', $sess_array);
			//ke halaman welcome page yang bersesuaian
			switch ($users[0]['id_grup']) {
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
		}
	}

	public function creatingAccount()
	{
		$this->load->helper(array('url', 'security'));
		$this->load->model('account');
		$this->load->library(array('form_validation'));

		$this->form_validation->set_rules(
			'nama',
			'Nama',
			'trim|min_length[2]|max_length[128]|xss_clean'
		);
		$this->form_validation->set_rules(
			'username',
			'Username',
			'trim|min_length[2]|max_length[128]|xss_clean'
		);
		$this->form_validation->set_rules(
			'password',
			'Password',
			'trim|min_length[2]|max_length[128]|xss_clean'
		);
		$this->form_validation->set_rules(
			'email',
			'Surel',
			'trim|valid_email|is_unique[users.email]|min_length[2]|max_length[128]|xss_clean',
			['is_unique' => '<div class="alert alert-danger" role="alert">This email has already registered!</div>']
		);

		$res = $this->form_validation->run();
		if ($res == FALSE) {
			$msg = validation_errors();
			$this->load->view('common/header');
			$this->load->view(
				'signup',
				array('msg' => $msg)
			);
			$this->load->view('common/header');
			return FALSE;
		}
		$this->account->insertNewUser();
		$this->load->view('common/header');
		$this->load->view(
			'login',
			array('msg' => '<div class="alert alert-success" 
			role="alert">Congratulation! your account has been created. Please Login</div>')
		);
		$this->load->view('common/footer');
		return;
	}


	public function logout()
	{
		if (!$this->session->userdata('logged_in')) {
			redirect('welcome/login');
		}
		$this->session->userdata('logged_in');
		$this->session->unset_userdata('logged_in');
		session_destroy();
		redirect("welcome");
	}

	public function changerole()
	{
		if (!$this->session->userdata('logged_in')) {
			redirect('welcome/login');
		}
		$session_data = $this->session->userdata('logged_in');

		$this->load->helper(array('form', 'url'));

		$this->load->model("account");
		$users = $this->account->getUser($session_data['id_user']);
		$roles = $this->account->getRoles($session_data['id_user']);

		if ($session_data['id_grup'] == 1) {
			$id_user = $session_data['id_user'];
			$switchidgrup = 2;
			$this->db->set('id_grup', $switchidgrup);
			$this->db->where('id_user', $id_user);
			$this->db->update('member');

			$this->session->set_userdata('logged_in');
			//ke halaman welcome page yang bersesuaian
			//			$peran= $this->account->getPeranUser($id_user);
			switch ($users[0]['id_grup']) {
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
		} elseif ($session_data['id_grup'] == 2) {
			$id_user = $session_data['id_user'];
			$switchidgrup = 1;
			$this->db->set('id_grup', $switchidgrup);
			$this->db->where('id_user', $id_user);
			$this->db->update('member');

			$this->session->set_userdata('logged_in');
			//ke halaman welcome page yang bersesuaian
			switch ($users[0]['id_grup']) {
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
		}
	}

	public function profile()
	{
		if (!$this->session->userdata('logged_in')) {
			redirect('welcome/login');
		}
		$session_data = $this->session->userdata('logged_in');

		$this->load->helper(array('form', 'url'));

		$this->load->model("account");
		$user = $this->account->getUser($session_data['id_user']);
		$roles = $this->account->getRoles($session_data['id_user']);
		$this->load->model(array('reviewer'));
		$saldo = $this->reviewer->getBalance($session_data['id_user']);

		$this->load->view(
			'common/header_' . $session_data['nama_grup'],
			array(
				"nama_user" => $session_data['namalengkap'],
				"current_role" => $session_data['nama_grup'],
				"saldo" => $saldo
			)
		);
		$this->load->view('profile', array(
			"error" => "",
			"user" => $user[0],
			"roles" => $roles
		));
		$this->load->view('common/footer');
	}


	public function editProfile()
	{
		if (!$this->session->userdata('logged_in')) {
			redirect('Welcome/login');
		}
		$session_data = $this->session->userdata('logged_in');
		$this->load->library(array('form_validation'));
		$this->load->helper(array('url', 'form', 'security'));
		$this->load->model("Account");
		$this->load->model(array('reviewer'));

		$user = $this->Account->getUser($session_data['id_user']);
		$roles = $this->Account->getRoles($session_data['id_user']);
		$saldo = $this->reviewer->getBalance($session_data['id_user']);

		$this->load->view(
			'common/header_' . $session_data['nama_grup'],
			array(
				"nama_user" => $session_data['namalengkap'],
				"current_role" => $session_data['nama_grup'],
				"saldo" => $saldo
			)
		);
		$this->load->view('editprofile', array(
			"error" => "",
			"user" => $user[0],
			"roles" => $roles
		));
		$this->load->view('common/footer');
	}

	public function editingProfile()
	{
		if (!$this->session->userdata('logged_in')) {
			redirect('Welcome/index');
		}
		$session_data = $this->session->userdata('logged_in');

		$this->load->helper(array('form', 'url', 'security'));
		$this->load->library(array('form_validation'));

		$this->form_validation->set_rules('nama', 'Nama', 'required|trim');
		if ($this->form_validation->run() == false) {
			redirect('AccountCtl/profile');
		} else {
			$nama = $this->input->post('nama');
			$username = $this->input->post('username');

			// cek jk ada gambar yang akan di upload
			$this->load->helper(array('form', 'url'));
			$upload_foto = $_FILES['photo']['name'];

			if ($upload_foto) {
				$config['allowed_types'] = 'gif|jpg|png';
				$config['max_size'] = '2048';
				$config['upload_path'] = './photos/';

				$this->load->library('upload', $config);

				if ($this->upload->do_upload('photo')) {

					$old_photo = $data['username']['photo'];
					if ($old_photo != 'default.jpg') {
						unlink(FCPATH . 'photos/' . $old_photo);
					}
					$new_photo = $this->upload->data('file_name');
					$this->db->set('photo', $new_photo);
				} else {
					$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">' . $this->upload->display_errors() . '</div>');
					redirect('AccountCtl/profile');
				}
			}
		}
		$this->db->set('nama', $nama);
		$this->db->where('username', $username);
		$this->db->update('users');

		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Akun telah berhasil diperbaharui </div>');
		redirect('AccountCtl/profile');
	}

	public function changePassword()
	{

		if (!$this->session->userdata('logged_in')) {
			redirect('Welcome/login');
		}
		$session_data = $this->session->userdata('logged_in');
		$this->load->library(array('form_validation'));
		$this->load->helper(array('form', 'url', 'security'));
		$this->load->model("Account");
		$user = $this->Account->getUser($session_data['id_user']);
		$roles = $this->Account->getRoles($session_data['id_user']);
		$this->load->model(array('reviewer'));
		$saldo = $this->reviewer->getBalance($session_data['id_user']);
		$this->load->view(
			'common/header_' . $session_data['nama_grup'],
			array(
				"nama_user" => $session_data['namalengkap'],
				"current_role" => $session_data['nama_grup'],
				"saldo" => $saldo
			)
		);
		$this->load->view('changepassword', array(
			"error" => "",
			"user" => $user[0],
			"roles" => $roles
		));
		$this->load->view('common/footer');
	}

	public function changingPassword()
	{
		if (!$this->session->userdata('logged_in')) {
			redirect('Welcome/index');
		}
		$session_data = $this->session->userdata('logged_in');
		$this->load->helper(array('form', 'url', 'security'));
		$this->load->library(array('form_validation'));
		$this->load->model("Account");

		$this->form_validation->set_rules('currentpassword', 'Current Password', 'required|trim', 'callback_password_check');
		$this->form_validation->set_rules('newpassword1', 'New Password', 'required|trim|min_length[5]|matches[newpassword2]');
		$this->form_validation->set_rules('newpassword2', 'Repeat Password', 'required|trim|min_length[5]|matches[newpassword1]');
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');

		if ($this->form_validation->run() == false) {
			$user = $this->Account->getUser($session_data['id_user']);
			$roles = $this->Account->getRoles($session_data['id_user']);
			$this->load->model(array('reviewer'));
			$saldo = $this->reviewer->getBalance($session_data['id_user']);
			$this->load->view(
				'common/header_' . $session_data['nama_grup'],
				array(
					"nama_user" => $session_data['namalengkap'],
					"current_role" => $session_data['nama_grup'],
					"saldo" => $saldo
				)
			);
			$this->load->view('changepassword', array(
				"error" => "",
				"user" => $user[0],
				"roles" => $roles
			));
			$this->load->view('common/footer');
		} else {
			$check = $this->Account->passwrod_check();
			if ($check == false) {
				$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Old Password not match!</div>');
				$user = $this->Account->getUser($session_data['id_user']);
				$roles = $this->Account->getRoles($session_data['id_user']);
				$this->load->view(
					'common/header_' . $session_data['nama_grup'],
					array(
						"nama_user" => $session_data['namalengkap'],
						"current_role" => $session_data['nama_grup']
					)
				);
				$this->load->view('changepassword', array(
					"error" => "",
					"user" => $user[0],
					"roles" => $roles
				));
				$this->load->view('common/footer');
			} else {
				$id_user = $session_data['id_user'];
				$newpass = $this->input->post('newpassword1');
				$this->Account->changePassword($id_user, array('password' => md5($newpass)));
				$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Password Changed!</div>');
				redirect('AccountCtl/profile');
			}
		}
	}
}
