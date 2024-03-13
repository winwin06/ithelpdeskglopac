<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->model('department_model');
		$this->load->model('job_request_model');
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

		$user = $this->db->get_where('user', ['email' => $email])->row_array();

		// jika usernya ada 
		if ($user) {
			// jika usernya aktif
			// if($user['is_active'] == 1) {

			// cek password
			if (password_verify($password, $user['password'])) {
				// password cocok
				$data = [
					'email' => $user['email'],
					'role'  => $user['role']
				];
				$this->session->set_userdata($data);
				redirect('welcome');
			} else {
				$this->session->set_flashdata('message', '<div class="alert
				alert-danger" role="alert">Wrong Password!</div>');
				redirect('');
			}
		} else {
			$this->session->set_flashdata('message', '<div class="alert 
			alert-danger" role="alert">This email has been not actived!</div>');
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
				'role'       	=> 2,
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

	public function dashboard()
	{
		$data['title'] 	= 'Dashboard';
		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('dashboard');
		$this->load->view('templates/footer');
	}

	public function department()
	{
		$data['title'] 		= 'Department';
		$data['department'] = $this->department_model->get_data('department')->result();
		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('department', $data);
		$this->load->view('templates/footer');
	}

	public function job_request()
	{
		$data['title'] = 'Job Request';
		$data['job_request'] = $this->job_request_model->get_data('job_request');

		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('job_request/job_request', $data);
		$this->load->view('templates/footer');
	}

	public function create_job_request()
	{
		$data['title'] = 'Create Job Request';
		$data['create_job_request'] = $this->job_request_model->get_data('create_job_request');

		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('job_request/create_job_request', $data);
		$this->load->view('templates/footer');
	}

	public function my_profile()
	{
		$data['title'] = 'My Profile';
		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('my_profile');
		$this->load->view('templates/footer');
	}

	public function logout()
	{
		$this->session->unset_userdata('email');
		$this->session->unset_userdata('role');

		$this->session->set_flashdata('message', '<div class="alert alert-success" 
			role="alert">You have been logged out</div>');
		redirect('');
	}
}
