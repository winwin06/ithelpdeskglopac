<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
	public function index()
	{
		$this->load->view('templates/header');
		// $this->load->view('templates/sidebar');
		$this->load->view('auth/login');
		$this->load->view('templates/footer');
	}

	public function dashboard()
	{
		$this->load->view('templates/header');
		$this->load->view('templates/sidebar');
		$this->load->view('dashboard');
		$this->load->view('templates/footer');
	}

	public function register()
	{
		$data['title'] = 'Glopac User Registration';
		$this->load->view('templates/auth_header', $data);
		$this->load->view('auth/registration');
		$this->load->view('templates/auth_footer');
	}
}
