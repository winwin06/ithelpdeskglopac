<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Department extends CI_Controller {
	public function index()
	{
		$data['title'] = 'Department';
		$this->load->view('templates/header');
		$this->load->view('templates/sidebar');
		$this->load->view('department');
		$this->load->view('templates/footer');
	}
}
