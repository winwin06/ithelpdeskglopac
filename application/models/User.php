<?php
class User extends CI_Model
{
    public $table   = 'user';
    public $id      = 'id';

    public function count_record($email, $password)
    {
        $kondisi = array(
            'email'    => $email,
            'password' => $password
        );
        $this->db->where($kondisi);
        $this->db->select("*");
        $this->db->from("user");
        $result = $this->db->get();
        return $result->num_rows();
    }

    public function index()
    {
        $data['data'] = $this->db->get_where('name', ['email' =>
        $this->session->userdata('email')])->row_array();

        $this->load->view('auth/index', $data);
    }

    public function hapus_record()
    {
    }

    public function update_record()
    {
    }

    public function kosongkan_table()
    {
    }

    public function get()
    {
        $this->db->from($this->table);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function getBy()
    {
        $email = $this->session->userdata('email');
        $this->db->from($this->table);
        $this->db->where('email', $email);
        $query = $this->db->get();
        return $query->row_array();
    }
}
