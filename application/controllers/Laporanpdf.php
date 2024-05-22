<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laporanpdf extends CI_Controller {
    function __construct(){
        parent::__construct();
        $this->load->library('Pdf'); // Memanggil library yang kita buat tadi
    }

    function index() {
        error_reporting(0); // Agar error masalah versi PHP tidak muncul
        $pdf = new Pdf('L', 'mm', 'A4');
        $pdf->AliasNbPages(); // Untuk menunjukkan jumlah halaman total
        $pdf->AddPage();
        
        // Tabel Header
        $pdf->SetFont('Arial', 'B', 8);
        $pdf->Cell(8, 7, 'No', 1, 0, 'C');
        $pdf->Cell(20, 7, 'Date', 1, 0, 'C');
        $pdf->Cell(35, 7, 'Job Title', 1, 0, 'C');
        $pdf->Cell(70, 7, 'Job Description', 1, 0, 'C');
        $pdf->Cell(28, 7, 'Department', 1, 0, 'C');
        $pdf->Cell(10, 7, 'Notes', 1, 0, 'C');
        $pdf->Cell(15, 7, 'Status', 1, 1, 'C');

        $pdf->SetFont('Arial', '', 8);

        // Fetching data from database
        $job_requests = $this->db->get('job_request')->result();
        $i = 1;
        foreach ($job_requests as $job) {
            $pdf->Cell(8, 5, $i++, 1, 0, 'C');
            $pdf->Cell(20, 5, $job->date, 1, 0, 'C');
            $pdf->Cell(35, 5, $job->job_title, 1, 0);
            $pdf->Cell(70, 5, $job->job_description, 1, 0);
            $pdf->Cell(28, 5, $job->department, 1, 0);
            $pdf->Cell(10, 5, $job->notes, 1, 0);
            $pdf->Cell(15, 5, $job->status, 1, 1, 'C');
        }

        $pdf->Output();
    }
}
