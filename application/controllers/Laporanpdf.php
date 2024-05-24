<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laporanpdf extends CI_Controller {
    function __construct(){
        parent::__construct();
        $this->load->library('Pdf'); // Memanggil library yang kita buat tadi
        $this->load->model('Job_request_model'); // Load model untuk mengambil data detail job request
    }

    function index() {
        error_reporting(0); // Agar error masalah versi PHP tidak muncul
        $pdf = new Pdf('L', 'mm', 'A4');
        $pdf->AliasNbPages(); // Untuk menunjukkan jumlah halaman total
        $pdf->AddPage();
        
        // Tabel Header
        $pdf->SetFont('Arial', 'B', 8);
        $pdf->Cell(8, 7, 'No', 1, 0, 'C');
        $pdf->Cell(18, 7, 'Date', 1, 0, 'C');
        $pdf->Cell(35, 7, 'Job Title', 1, 0, 'C');
        $pdf->Cell(72, 7, 'Job Description', 1, 0, 'C');
        $pdf->Cell(25, 7, 'Department', 1, 0, 'C');
        $pdf->Cell(12, 7, 'Notes', 1, 0, 'C');
        $pdf->Cell(20, 7, 'Status', 1, 1, 'C');

        $pdf->SetFont('Arial', '', 8);

        // Fetching data from database
        $job_requests = $this->db->get('job_request')->result();
        $i = 1;
        foreach ($job_requests as $job) {
            $pdf->Cell(8, 5, $i++, 1, 0, 'C');
            $pdf->Cell(18, 5, $job->date, 1, 0, 'C');
            $pdf->Cell(35, 5, $job->job_title, 1, 0);
            $pdf->Cell(72, 5, $job->job_description, 1, 0);
            $pdf->Cell(25, 5, $job->department, 1, 0);
            $pdf->Cell(12, 5, $job->notes, 1, 0);
            $pdf->Cell(20, 5, $job->status, 1, 1, 'C');
        }

        $pdf->Output();
    }

    function detail($id) {
        error_reporting(0); // Agar error masalah versi PHP tidak muncul
        $pdf = new Pdf('L', 'mm', 'A4');
        $pdf->AliasNbPages(); // Untuk menunjukkan jumlah halaman total
        $pdf->AddPage();
        
        // Tabel Header
        $pdf->SetFont('Arial', 'B', 8);
        $pdf->Cell(8, 7, 'No', 1, 0, 'C');
        $pdf->Cell(18, 7, 'Date', 1, 0, 'C');
        $pdf->Cell(35, 7, 'Job Title', 1, 0, 'C');
        $pdf->Cell(72, 7, 'Job Description', 1, 0, 'C');
        $pdf->Cell(25, 7, 'Department', 1, 0, 'C');
        $pdf->Cell(12, 7, 'Notes', 1, 0, 'C');
        $pdf->Cell(20, 7, 'Status', 1, 1, 'C');
    
        $pdf->SetFont('Arial', '', 8);
    
        // Fetching data from database based on $id
        $job_request = $this->Job_request_model->getJobRequestById($id);
    
        
        if ($job_request) {
            $pdf->Cell(8, 5, '1', 1, 0, 'C'); // Contoh nomor
            $pdf->Cell(18, 5, $job_request['date'], 1, 0, 'C');
            $pdf->Cell(35, 5, $job_request['job_title'], 1, 0);
            $pdf->Cell(72, 5, $job_request['job_description'], 1, 0);
            $pdf->Cell(25, 5, $job_request['department'], 1, 0);
            $pdf->Cell(12, 5, $job_request['notes'], 1, 0);
            $pdf->Cell(20, 5, $job_request['status'], 1, 1, 'C');
        } else {
            $pdf->Cell(0, 10, 'Job request not found!', 0, 1);
        }
    
        $pdf->Output();
    }
    
}
?>

