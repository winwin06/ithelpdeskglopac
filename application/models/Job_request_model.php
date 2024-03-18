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

	public function get_data()
	{
		$query = $this->db->get('job_request');
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
}



	
	// public function update($where, $data)
	// {
	// 	$this->db->update($this->table, $data, $where);
	// 	return $this->db->affected_rows();
	// }
	// public function insert($data)
	// {
	// 	$this->db->insert($this->table, $data);
	// 	return $this->db->insert_id();
	// }
	// public function delete($id)
	// {
	// 	$this->db->where($this->id, $id);
	// 	$this->db->delete($this->table);
	// 	return $this->db->affected_rows();
	// }
