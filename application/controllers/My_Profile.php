<?php
defined('BASEPATH') or exit('No direct script access allowed');

class My_Profile extends CI_Controller
{
    public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->model('user', 'userrole');
	}


	public function index()
	{

        $data['user']	= $this->userrole->getBy();
        $data['title']	 = 'My Profile';
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('my_profile', $data);
        $this->load->view('templates/footer');
		
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
