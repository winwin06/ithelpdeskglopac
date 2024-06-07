<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Job_request_model extends CI_Model
{
	public $table = 'job_request';
	public $id = 'id';

	public function __construct()
	{
		parent::__construct();
	}

	public function get_data($current_month_start = null)
	{
		$post = $this->input->post();

		// Filter Berdasarkan Date From
		if (isset($post['dateFrom']) && $post['dateFrom'] != '') {
			$this->db->where('created_at >=', $post['dateFrom']); // Menggunakan '>='
		} else if ($current_month_start) {
			$this->db->where('created_at >=', $current_month_start); // Data dari awal bulan saat ini
		}

		// Filter Berdasarkan Date To
		if (isset($post['dateTo']) && $post['dateTo'] != '') {
			$this->db->where('created_at <=', $post['dateTo'] . ' 23:59:59'); // Menggunakan '<='
		}

		// Filter Berdasarkan Status
		if (isset($post['status']) && $post['status'] != '') {
			$conditions = array('status' => $post['status']);
			$this->db->where($conditions);
		}

		$this->db->select('*');
		$this->db->from($this->table);

		$query = $this->db->get();
		return $query->result_array();
	}

	public function getJobRequestById($id)
	{
		$this->db->where($this->id, $id);
		return $this->db->get($this->table)->row_array();
	}

	public function insert($data)
	{
		$this->db->insert($this->table, $data);
		return $this->db->insert_id();
	}

	public function update($where, $data)
	{
		$this->db->where('id', $this->input->post('id'));
		$this->db->update('job_request', $data, $where);
	}

	public function delete($id)
	{
		$this->db->where('id', $id);
		$this->db->delete('job_request');
	}

	public function get_all_job_request()
	{
		return $this->db->get('job_request')->result_array();
	}

	public function get_job_by_id($id)
	{
		$this->db->where('id', $id);
		return $this->db->get('job_request')->row_array();
	}

	public function get_filtered_data($dateFrom = null, $dateTo = null)
	{
		// Filter Berdasarkan Date From
		if (!empty($dateFrom)) {
			$this->db->where('date >=', $dateFrom);
		}

		// Filter Berdasarkan Date To
		if (!empty($dateTo)) {
			$this->db->where('date <=', $dateTo . ' 23:59:59');
		}

		// Filter Berdasarkan Status
		// if (!empty($status)) {
		//     $this->db->where('status', $status);
		// }

		$this->db->select('*');
		$this->db->from($this->table);

		$query = $this->db->get();
		return $query->result();
	}
}
