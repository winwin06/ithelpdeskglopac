<?php
class User extends CI_Model
{
    // Menentukan nama tabel dan id utama
    public $table   = 'user';
    public $id      = 'id';

    public function __construct()
	{
		parent::__construct();
		$this->load->model('user');
	}

    // Menghitung jumlah record pengguna berdasarkan email dan password
    public function count_record($email, $password)
    {
        // Menentukan kondisi pencarian berdasarkan email dan password
        $kondisi = array(
            'email'    => $email,
            'password' => $password
        );

        // Mengambil data berdasarkan kondisi pencarian
        $this->db->where($kondisi);
        $this->db->select("*");
        $this->db->from("user");
        $result = $this->db->get();

        // Mengembalikan jumlah record yang ditemukan
        return $result->num_rows();
    }

    public function index()
    {
        $data['data'] = $this->db->get_where('name', ['email' =>
        $this->session->userdata('email')])->row_array();

        $this->load->view('auth/index', $data);
    }

    public function getBy()
    {
        // Mendapatkan email pengguna yang sedang login
        $email = $this->session->userdata('email');

        // Mengambil data pengguna berdasarkan email yang ada dalam sesi
        $this->db->from($this->table);
        $this->db->where('email', $email);
        $query = $this->db->get();
        // Mengembalikan data pengguna yang ditemukan
        return $query->row_array();
    }

    public function getUser($field, $value)
    {
         // Mengambil data pengguna berdasarkan kondisi field dan nilai tertentu
        return $this->db->get_where('user', [$field => $value])->row_array();
        
    }
}
