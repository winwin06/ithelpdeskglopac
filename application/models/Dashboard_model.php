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
        // Ambil jumlah job berdasarkan bulan dari kolom created_at
        $this->db->select('MONTH(created_at) as month, COUNT(*) as job_count');
        $this->db->group_by('MONTH(created_at)');
        $query = $this->db->get('job_request');
        $result = $query->result_array();
    
        // Siapkan array untuk 12 bulan, default 0
        $jobRequests = array_fill(0, 12, 0); // Indeks dari 0 (Januari) sampai 11 (Desember)
    
        // Isi array berdasarkan data dari database
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