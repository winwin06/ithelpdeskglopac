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

	// public function get_data($dateFrom ='', $dateTo = '', $status = '')
	// {
	// 	$this->db->select('*');
	// 	$this->db->from('job_request');

	// 	// Filter berdasarkan tanggal
	// 	if (!empty($dateFrom) && !empty($dateTo)) {
	// 		$this->db->where('created_at >=', $dateFrom);
	// 		$this->db->where('created_at <=', $dateTo);
	// 	}
	// 	// Filter berdasarkan status
	// 	if (!empty($status)) {
	// 		$this->db->where('status', $status);
	// 	}

	// 	$query = $this->db->get();
	// 	return $query->result_array();
	// }

	public function get_data()
	{
		$post = $this->input->post();
		//Filter Berdasarkan Date From
		if (isset($post['dateFrom']) and $post['dateFrom'] !='') {
			$this->db->where('created_at' >= date('Y-m-d')); 
		}else{
			echo 'data tidak ada';
		}
		
		
		


		//Filter Berdasarkan Status
		if (isset($post['status']) and $post['status'] != '') {
			$conditions = array('status' => $post['status']);
			$this->db->where($conditions);
		}
		// $this->output->enable_profiler();


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
}
