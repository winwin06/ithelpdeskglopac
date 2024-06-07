<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard_model extends CI_Model
{
    public function total_job() 
    {
        return $this->db->get('job_request')->num_rows();
    } 

    public function total_user() 
    {
        return $this->db->get('user')->num_rows();
    } 

    public function get_job_requests() 
    {
        return $this->db->get('job_request')->result_array();
    }

    public function count_status_job($status) 
    {
        return $this->db->where('status', $status)->from('job_request')->count_all_results();
    }

}