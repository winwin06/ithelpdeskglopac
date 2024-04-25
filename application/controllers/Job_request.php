<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Job_request extends CI_Controller
{

    public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->model('job_request_model');
	}

	public function index()
	{
        $data['title'] 			= 'Job Request';
		$data['job_request'] 	= $this->job_request_model->get_data('job_request');

		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('job_request/job_request', $data);
		$this->load->view('templates/footer');
	}

    public function create_job()
	{
		$data['title'] = "Add a Job Request";

		$this->form_validation->set_rules('job_title', 'Job Title', 'required|trim');
		$this->form_validation->set_rules('job_description', 'Job Description', 'required|trim');
		$this->form_validation->set_rules('department', 'Department', 'required|trim');
		
		// Jika pengguna adalah "admin", tambahkan aturan validasi untuk status
		if ($this->session->userdata("role") == "admin") {
			$this->form_validation->set_rules('status', 'Status', 'required|trim');
		}

		if ($this->form_validation->run() == false) {
			$this->load->view('templates/header', $data);
			$this->load->view('templates/sidebar', $data);
			$this->load->view('job_request/create_job', $data);
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
			redirect('job_request');
		}
	}

    public function edit_job($id)
	{
		$data['title'] = "Edit Job Request Data";
		$data['job_request'] = $this->job_request_model->getJobRequestById($id);
		$data['status'] = ['Not Started', 'On Going', 'Done'];

		$this->form_validation->set_rules('job_title', 'Job Title', 'required|trim');
		$this->form_validation->set_rules('job_description', 'Job Description', 'required|trim');
		$this->form_validation->set_rules('department', 'Department', 'required|trim');
	
		// Jika pengguna adalah "admin", tambahkan aturan validasi untuk status
		if ($this->session->userdata("role") == "admin") {
			$this->form_validation->set_rules('status', 'Status', 'required|trim');
		}

		if ($this->form_validation->run() == false) {
			$this->load->view('templates/header', $data);
			$this->load->view('templates/sidebar', $data);
			$this->load->view('job_request/edit_job', $data);
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
			redirect('job_request');
		}
	}

    public function detail_job($id)
	{
		$data['title'] 			= "Detail Job Request Data";
		$data['job_request'] 	= $this->job_request_model->getJobRequestById($id);
		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar');
		$this->load->view('job_request/detail_job', $data);
		$this->load->view('templates/footer');
	}

	public function delete_job($id)
	{
		$job_request = $this->job_request_model->get_job_by_id($id);
		
		// Periksa peran pengguna
		if ($this->session->userdata("role") == "admin") {
			// Jika pengguna adalah admin, izinkan penghapusan tanpa memperdulikan status
			$this->job_request_model->delete($id);
			$this->session->set_flashdata('flash', 'Berhasil Dihapus');
		} else {
			// Jika pengguna adalah user
			// Periksa jika statusnya bukan "Not Started"
			if ($job_request['status'] != 'Not Started') {
				// Tampilkan pesan bahwa pekerjaan dengan status selain "Not Started" tidak bisa dihapus
				$this->session->set_flashdata('flash', 'Maaf tidak bisa dihapus.');
			} else {
				// Jika status "Not Started", izinkan penghapusan
				$this->job_request_model->delete($id);
				$this->session->set_flashdata('flash', 'Berhasil Dihapus');
			}
		}
		redirect('job_request');
	}

    public function job_history()
	{
		$data['title'] 	= 'Job Request History';
		$data['job_request'] = $this->job_request_model->get_all_job_request();

		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('job_request/job_history');
		$this->load->view('templates/footer');
	}
}