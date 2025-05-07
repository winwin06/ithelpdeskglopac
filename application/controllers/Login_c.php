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

        // Pastikan email dan password telah diisi
        if (!empty($email) && !empty($password)) {
            // Periksa login menggunakan model user
            $count = $this->user->count_record($email, $password);

            if ($count != 0) {
                // Ambil data user dari database berdasarkan email
                $user = $this->db->get_where('user', ['email' => $email])->row_array();

                // Simpan data user ke dalam session
                $data = [
                    'email' => $user['email'],
                    'role'  => $user['role']
                ];
                $this->session->set_userdata($data);

                // Redirect sesuai peran user
                if ($user['role'] == 'user') {
                    redirect('dashboard');
                } else if ($user['role'] == 'admin') {
                    redirect('dashboard');
                } else {
                    // Jika role tidak dikenali
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Invalid user role!</div>');
                    redirect('');
                }
            } else {
                // Login gagal
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Invalid email or password!</div>');
                redirect('');
            }
        } else {
            // Jika email atau password kosong, tampilkan pesan kesalahan
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Email and password are required!</div>');
            redirect('');
        }

        // Aktifkan profiler untuk debugging 
        $this->output->enable_profiler();
    }
    
}
