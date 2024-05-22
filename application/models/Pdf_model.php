<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pdf_model extends CI_Model
{
    public $table = 'job_request';
    public $id = 'id';

    public function __construct()
    {
        parent::__construct();
        $this->load->model('pdf_model');
    }

    public function get_data()
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $query = $this->db->get();
        return $query->result_array();
    }
}
