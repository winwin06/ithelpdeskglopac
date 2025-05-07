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
		$data['title'] = 'Job Request';
		$post = $this->input->post();

		// Dapatkan tanggal awal bulan saat ini
		$current_month_start = date('Y-m-01');
		$current_date = date('01/M/Y'); // Format hari, bulan, dan tahun
		$alert_message = "Info: Data from {$current_date}, use filter to load more data.";

		// Ambil data berdasarkan filter atau dari bulan saat ini
		$data['job_request'] = $this->job_request_model->get_data($current_month_start);

		// Buat pesan alert dinamis
		$data['alert_message'] = $alert_message;

		// Data Post
		$data['post'] = $this->input->post();

		// Tampilkan halaman job request
		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('job_request/job_request', $data);
		$this->load->view('templates/footer');
	}

	public function create_job()
	{
		$data['title'] = "Add a Job Request";

		// Validasi form input dasar
		$this->form_validation->set_rules('date', 'Date', 'required|trim');
		$this->form_validation->set_rules('job_title', 'Job Title', 'required|trim');
		$this->form_validation->set_rules('job_description', 'Job Description', 'required|trim');
		$this->form_validation->set_rules('department', 'Department', 'required|trim');

		// Jika role adalah "admin",  wajib isi status
		if ($this->session->userdata("role") == "admin") {
			$this->form_validation->set_rules('status', 'Status', 'required|trim');
		}

		// Jika validasi gagal, tampilkan form ulang
		if ($this->form_validation->run() == false) {
			$this->load->view('templates/header', $data);
			$this->load->view('templates/sidebar', $data);
			$this->load->view('job_request/create_job', $data);
			$this->load->view('templates/footer');
		} else {
			// Simpan data dari form ke array
			$data = [
				'date'		        => $this->input->post('date'),
				'job_title'         => $this->input->post('job_title'),
				'job_description'   => $this->input->post('job_description'),
				'department'	   	=> $this->input->post('department'),
				'notes'             => $this->input->post('notes'),
				'status'            => $this->input->post('status'),
				'created_at' 		=> date('Y-m-d H:i:s'),
			];

			// Proses upload gambar jika ada
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

			// Simpan data ke database
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

		// Validasi form input
		$this->form_validation->set_rules('date', 'Date', 'required|trim');
		$this->form_validation->set_rules('job_title', 'Job Title', 'required|trim');
		$this->form_validation->set_rules('job_description', 'Job Description', 'required|trim');
		$this->form_validation->set_rules('department', 'Department', 'required|trim');

		// Jika pengguna adalah "admin", tambahkan aturan validasi untuk status
		if ($this->session->userdata("role") == "admin") {
			$this->form_validation->set_rules('status', 'Status', 'required|trim');
		}

		// Jika validasi gagal, tampilkan kembali form
		if ($this->form_validation->run() == false) {
			$this->load->view('templates/header', $data);
			$this->load->view('templates/sidebar', $data);
			$this->load->view('job_request/edit_job', $data);
			$this->load->view('templates/footer');
		} else {
			// Ambil data inputan baru
			$data = [
				'date' 				=> $this->input->post('date'),
				'job_title' 		=> $this->input->post('job_title'),
				'job_description' 	=> $this->input->post('job_description'),
				'department' 		=> $this->input->post('department'),
				'notes' 			=> $this->input->post('notes'),
				'status' 			=> $this->input->post('status'),
				'updated_at' 		=> date('Y-m-d H:i:s'),

			];

			// Proses upload gambar baru jika ada
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

			// Update data di database
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

		if ($this->session->userdata("role") == "admin") {
			// Jika role adalah admin, izinkan penghapusan tanpa memperdulikan status
			$this->job_request_model->delete($id);
			$this->session->set_flashdata('flash', 'Berhasil Dihapus');
		} else {
			// User hanya bisa hapus jika status "Not Started"
			if ($job_request['status'] != 'Not Started') {
				$this->session->set_flashdata('flash', 'Maaf tidak bisa dihapus.');
			} else {
				$this->job_request_model->delete($id);
				$this->session->set_flashdata('flash', 'Berhasil Dihapus');
			}
		}
		redirect('job_request');
	}

	public function job_history()
	{
		$data['title'] 	= 'Job Request History';
		$data['job_request'] = $this->job_request_model->get_done_job_request();

		// Tampilkan halaman histori job
		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('job_request/job_history');
		$this->load->view('templates/footer');
	}
}
