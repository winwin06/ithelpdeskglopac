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

    // public function get_job_requests() 
    // {
    //     return $this->db->get('job_request')->result_array();
    // }

    // public function get_job_requests()
    // {
    //     $this->db->select('MONTH(created_at) as month, COUNT(*) as job_count');
    //     $this->db->group_by('MONTH(created_at)');
    //     $query = $this->db->get('job_request');
    //     return $query->result_array();
    // }   

    public function get_job_requests()
    {
        $this->db->select('MONTH(created_at) as month, COUNT(*) as job_count');
        $this->db->group_by('MONTH(created_at)');
        $query = $this->db->get('job_request');
        $result = $query->result_array();
    
        // Buat array dengan nilai default 0 untuk setiap bulan
        $jobRequests = array_fill(0, 12, 0); // Indeks dari 0 (Januari) sampai 11 (Desember)
    
        // Isi data job count berdasarkan hasil query
        foreach ($result as $row) {
            $jobRequests[intval($row['month']) - 1] = $row['job_count'];
        }
    
        return $jobRequests;
    }


    public function count_status_job($status) 
    {
        return $this->db->where('status', $status)->from('job_request')->count_all_results();
    }

}