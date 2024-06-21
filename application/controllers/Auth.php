<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->model('job_request_model');
		$this->load->model('user', 'userrole');
	}

	public function index()
	{
		$this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email');
		$this->form_validation->set_rules('password', 'Password', 'required|trim');
		if ($this->form_validation->run() == false) {
			$data['title'] = 'Glopac User Login';
			$this->load->view('templates/auth_header', $data);
			$this->load->view('auth/login');
			$this->load->view('templates/auth_footer');
		} else {
			// validasinya success
			$this->_login();
		}
	}

	private function _login()
	{
		$email = $this->input->post('email');
		$password = $this->input->post('password');

		// Periksa apakah email tidak kosong
		if (!empty($email)) {
			$user = $this->db->get_where('user', ['email' => $email])->row_array();

			// Periksa apakah user ditemukan
			if ($user) {
				// Periksa password dengan password_verify()
				if (password_verify($password, $user['password'])) {
					$data = [
						'email' => $user['email'],
						'role'  => $user['role'],
						'id'    => $user['id']
					];
					$this->session->set_userdata($data);

					// Redirect sesuai peran user
					if ($user['role'] == 'user') {
						redirect('dashboard');
					} else if ($user['role'] == 'admin') {
						redirect('dashboard');
					} else {
						// Jika peran tidak didefinisikan, tampilkan pesan kesalahan
						$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Invalid user role!</div>');
						redirect('');
					}
				} else {
					// Password salah, tampilkan pesan kesalahan
					$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Wrong Password!</div>');
					redirect('');
				}
			} else {
				// Email tidak ditemukan, tampilkan pesan kesalahan
				$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">This email has not been activated!</div>');
				redirect('');
			}
		} else {
			// Jika email kosong, tampilkan pesan kesalahan
			$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Email field is required!</div>');
			redirect('');
		}
	}


	public function registration()
	{
		$this->form_validation->set_rules('name', 'Name', 'required|trim');
		$this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email', [
			'valid_email' => 'This email has alredy registered!'
		]);
		$this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[8]|matches[password2]', [
			'matches'    => 'Password dont match!',
			'min_length' => 'Password too short!'
		]);
		$this->form_validation->set_rules('password2', 'Password', 'required|trim|matches[password1]');

		if ($this->form_validation->run() == false) {
			$data['title']	 = 'Glopac User Registration';
			$this->load->view('templates/auth_header', $data);
			$this->load->view('auth/registration');
			$this->load->view('templates/auth_footer');
		} else {
			$data = [
				'name'  		=> $this->input->post('name'),
				'email' 		=> $this->input->post('email'),
				'password' 		=> $this->input->post('password1'),
				'role'       	=> 1,
				'created_at' 	=> date('Y-m-d H:i:s'),
				// 'updated_at' => time(),
			];

			$this->db->insert('user', $data);
			$this->session->set_flashdata('message', '<div class="alert alert-success" 
			role="alert">Congratulation! Your account has been 
			created. Please Login</div>');
			redirect('');
		}

		// $this->output->enable_profiler();
	}


	public function logout()
	{
		$this->session->unset_userdata('email');
		$this->session->unset_userdata('role');

		$this->session->set_flashdata('message', '<div class="alert alert-success" 
			role="alert">You have been logged out</div>');
		redirect('');
	}

	
	public function forgot_password()
	{
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
		if ($this->form_validation->run() == false) {
			$data['title'] = "Forgot Password";
			$this->load->view('templates/auth_header', $data);
			$this->load->view('auth/forgot_password', $data);
			$this->load->view('templates/auth_footer');
		} else {
			$email = $this->input->post('email');
			$user = $this->db->get_where('user', ['email' => $email])->row_array();

			if ($user) {
				$token = base64_encode(random_bytes(32));
				$user_token = [
					'email'			=> $email,
					'token'			=> $token,
					'created_at'	=> date('Y-m-d H:i:s'),
				];

				$this->db->insert('user_token', $user_token);
			} else {
				$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Email is not registered</div>');
				redirect('dashboard/forgot_password');
			}
		}
	}

	
}
