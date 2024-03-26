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

        // Periksa apakah email dan password tidak kosong
        if (!empty($email) && !empty($password)) {
            // Periksa login menggunakan model user
            $count = $this->user->count_record($email, $password);

            if ($count != 0) {
                $user = $this->db->get_where('user', ['email' => $email])->row_array();

                // Set session data
                $data = [
                    'email' => $user['email'],
                    'role'  => $user['role']
                ];
                $this->session->set_userdata($data);

                // Redirect sesuai peran user
                if ($user['role'] == 'user') {
                    redirect('job_request');
                } else if ($user['role'] == 'admin') {
                    redirect('dashboard');
                } else {
                    // Jika peran tidak didefinisikan, tampilkan pesan kesalahan
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Invalid user role!</div>');
                    redirect('');
                }
            } else {
                // Login gagal, tampilkan pesan kesalahan
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Invalid email or password!</div>');
                redirect('');
            }
        } else {
            // Jika email atau password kosong, tampilkan pesan kesalahan
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Email and password are required!</div>');
            redirect('');
        }
        $this->output->enable_profiler();
    }
    
}
