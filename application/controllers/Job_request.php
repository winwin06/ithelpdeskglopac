<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Job_request extends CI_Controller
{
    public function create()
    {
        $data['judul']  = "Create Job Request";
        $data['user']   = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['job_request'] = $this->job_request_model->get();
        $this->form_validation->set_rules('job_title', 'Job Title', 'required|trim');
        $this->form_validation->set_rules('job_description', 'Job Description', 'required|trim');
        $this->form_validation->set_rules('notes', 'Notes', 'required|trim');
        $this->form_validation->set_rules('image', 'Image', 'required|trim');
        $this->form_validation->set_rules('status', 'Status', 'required|trim');
        
        if ($this->form_validation->run() == false) {
            $this->load->view("layout/header", $data);
            $this->load->view("job_request/create_job_request", $data);
            $this->load->view("layout/footer");
        } else {
            $data = [
                'job_title'         => $this->input->post('job_title'),
                'job_description'   => $this->input->post('job_description'),
                'notes'             => $this->input->post('notes'),
                'image'             => $this->input->post('image'),
                'status'            => $this->input->post('status'),
            ];
            $this->job_request_model->insert($data);
            $this->session->set_flashdata('message', '<div class="alert alert-success"
            role="alert">Job Request Successfully Added!</div>');
            redirect('job_request');
        }
    }

	
}
