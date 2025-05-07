<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
    public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->model('user', 'userrole');
		$this->load->model('dashboard_model');
	}

    public function index()
    {
        $data['title']         = 'Dashboard';
        // Ambil total job, user dan job_request dari model
        $data['total_job']     = $this->dashboard_model->total_job();
        $data['total_user']    = $this->dashboard_model->total_user();
        $data['job_request']   = $this->dashboard_model->get_job_requests();

        // Hitung jumlah status job
        $data['not_started']   = $this->dashboard_model->count_status_job('Not Started');
        $data['on_going']      = $this->dashboard_model->count_status_job('On Going');
        $data['done']          = $this->dashboard_model->count_status_job('Done');

         // Ambil data user yang sedang login menggunakan model userrole
        $data['user'] = $this->userrole->getBy();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('dashboard', $data);
        $this->load->view('templates/footer');
    }

}
