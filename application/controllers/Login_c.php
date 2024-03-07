<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login_c extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('user');
    }

    // Check Login
    public function check_login()
    {
        $post     = $this->input->post();
        $email    = $post['email'];
        $password = $post['password'];

        $count = $this->user->count_record($email, $password);

        if ($count != 0) {
            redirect('dashboard/dashboard');
        } else {
            redirect('dashboard/index');
        }

        // $this->output->enable_profiler();

    }
}
