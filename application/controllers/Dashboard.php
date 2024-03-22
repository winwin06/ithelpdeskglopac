<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
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

		$user = $this->db->get_where('user', ['email' => $email])->row_array();
		if ($user) {
			if (password_verify($password, $user['password'])) {
				$data = [
					'email' => $user['email'],
					'role'  => $user['role'],
					'id'    => $user['id']
				];
				$this->session->set_userdata($data);
				if ($user['role'] == '1') {
					redirect('dashboard/job_request');
				} else if ($user['role'] == '2') {
					redirect('dashboard');
				}
			} else {
				$this->session->set_flashdata('message', '<div class="alert
                alert-danger" role="alert">Wrong Password!</div>');
				redirect('');
			}
		} else {
			$this->session->set_flashdata('message', '<div class="alert 
            alert-danger" role="alert">This email has not been activated!</div>');
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

	public function dashboard()
	{
		$data['title'] 	= 'Dashboard';
		$data['user']	= $this->userrole->getBy();

		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('dashboard', $data);
		$this->load->view('templates/footer');
	}

	public function job_request()
	{
		$data['title'] 			= 'Job Request';
		$data['job_request'] 	= $this->job_request_model->get_data('job_request');

		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('job_request/job_request', $data);
		$this->load->view('templates/footer');
	}

	public function create_job_request()
	{
		$data['title'] = "Add a Job Request";

		$this->form_validation->set_rules('job_title', 'Job Title', 'required|trim');
		$this->form_validation->set_rules('job_description', 'Job Description', 'required|trim');
		$this->form_validation->set_rules('department', 'Department', 'required|trim');
		$this->form_validation->set_rules('notes', 'Notes', 'required|trim');
		$this->form_validation->set_rules('status', 'Status', 'required|trim');

		if ($this->form_validation->run() == false) {
			$this->load->view('templates/header', $data);
			$this->load->view('templates/sidebar', $data);
			$this->load->view('job_request/create_job_request', $data);
			$this->load->view('templates/footer');
		} else {
			$data = [
				'job_title'         => $this->input->post('job_title'),
				'job_description'   => $this->input->post('job_description'),
				'department'	   	=> $this->input->post('department'),
				'notes'             => $this->input->post('notes'),
				'status'            => $this->input->post('status'),
				'created_at' 		=> date('Y-m-d H:i:s'),
			];

			$upload_image = $_FILES['image']['name'];
			if ($upload_image) {
				$config['allowed_types'] = 'gif|jpg|jpeg|png';
				$config['max_size'] = '10240';
				$config['upload_path'] = './assets/dist/img/job_request/';

				// Pastikan direktori upload ada dan memiliki izin yang sesuai
				if (!is_dir($config['upload_path'])) {
					mkdir($config['upload_path'], 0777, true);
				}

				$this->load->library('upload', $config);

				if ($this->upload->do_upload('image')) {
					$new_image = $this->upload->data('file_name');
					$data['image'] = $new_image; // Simpan nama file gambar ke dalam array $data
				} else {
					echo $this->upload->display_errors();
					return; // Hentikan eksekusi jika terjadi error pada upload gambar
				}
			}

			$this->job_request_model->insert($data);
			$this->session->set_flashdata('flash', 'Ditambahkan');
			redirect('dashboard/job_request');
		}
	}

	public function delete_job_request($id)
	{
		$this->job_request_model->delete($id);
		$this->session->set_flashdata('flash', 'Dihapus');
		redirect('dashboard/job_request');
	}

	public function detail_job_request($id)
	{
		$data['title'] 			= "Detail Job Request Data";
		$data['job_request'] 	= $this->job_request_model->getJobRequestById($id);
		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar');
		$this->load->view('job_request/detail_job_request', $data);
		$this->load->view('templates/footer');
	}

	public function edit_job_request($id)
	{
		$data['title'] = "Edit Job Request Data";
		$data['job_request'] = $this->job_request_model->getJobRequestById($id);
		$data['status'] = ['Not Started', 'On Going', 'Done'];

		$this->form_validation->set_rules('job_title', 'Job Title', 'required|trim');
		$this->form_validation->set_rules('job_description', 'Job Description', 'required|trim');
		$this->form_validation->set_rules('department', 'Department', 'required|trim');
		$this->form_validation->set_rules('notes', 'Notes', 'required|trim');
		$this->form_validation->set_rules('status', 'Status', 'required|trim');

		if ($this->form_validation->run() == false) {
			$this->load->view('templates/header', $data);
			$this->load->view('templates/sidebar', $data);
			$this->load->view('job_request/edit_job_request', $data);
			$this->load->view('templates/footer');
		} else {
			$data = [
				'job_title' 		=> $this->input->post('job_title'),
				'job_description' 	=> $this->input->post('job_description'),
				'department' 		=> $this->input->post('department'),
				'notes' 			=> $this->input->post('notes'),
				'status' 			=> $this->input->post('status'),
				'updated_at' 		=> date('Y-m-d H:i:s'),

			];
			$upload_image = $_FILES['image']['name'];
			if ($upload_image) {
				$config['allowed_types'] = 'gif|jpg|jpeg|png';
				$config['max_size'] = '10240';
				$config['upload_path'] = './assets/dist/img/job_request/';

				$this->load->library('upload', $config);

				if ($this->upload->do_upload('image')) {
					$old_image = $data['job_request']['image'];
					if ($old_image != 'default.jpg') {
						unlink(FCPATH . 'assets/dist/img/job_request/' . $old_image);
					}
					$new_image = $this->upload->data('file_name');
					$data['image'] = $new_image;
				} else {
					echo $this->upload->display_errors();
					return;
				}
			}
			$this->job_request_model->update(['id' => $id], $data);
			$this->session->set_flashdata('flash', 'Diupdate');
			redirect('dashboard/job_request');
		}
	}

	public function logout()
	{
		$this->session->unset_userdata('email');
		$this->session->unset_userdata('role');

		$this->session->set_flashdata('message', '<div class="alert alert-success" 
			role="alert">You have been logged out</div>');
		redirect('');
	}

	public function list_job()
	{
		$data['title'] 	= 'History of Job Request';
		$data['job_request'] = $this->job_request_model->get_all_job_request();

		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('job_request/history_job');
		$this->load->view('templates/footer');
	}

	public function my_profile()
	{
		$data['user']	= $this->userrole->getBy();
		$data['title']	 = 'My Profile';
		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('my_profile', $data);
		$this->load->view('templates/footer');
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

	public function user_page()
	{
		$data['user']	= $this->userrole->getBy();
		$data['title'] 	= 'User';
		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('user_page', $data);
		$this->load->view('templates/footer');

		if ($this->session->userdata('email')) {
			// Ambil data user yang sedang login
			$data['user'] = $this->user->getUser('email', $this->session->userdata('email'));
		} else {
			// Jika tidak ada pengguna yang login, redirect ke halaman login
			redirect('');
		}
	}
}
