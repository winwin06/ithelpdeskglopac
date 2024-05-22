<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pdf_c extends CI_Controller {
    function __construct(){
        parent::__construct();
        $this->load->library('Pdf'); // Memanggil library yang kita buat tadi
    }

    function index() {
        error_reporting(0); // Agar error masalah versi PHP tidak muncul
        $pdf = new FPDF('L', 'mm', 'Letter');
        $pdf->AddPage();
        $pdf->SetFont('Arial', 'B', 16);
        $pdf->Cell(0, 7, 'Job Request', 0, 1, 'C');
        $pdf->Cell(10, 7, '', 0, 1);
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(10, 6, 'No', 1, 0, 'C');
        $pdf->Cell(40, 6, 'Date', 1, 0, 'C');
        $pdf->Cell(50, 6, 'Job Title', 1, 0, 'C');
        $pdf->Cell(50, 6, 'Job Description', 1, 0, 'C');
        $pdf->Cell(40, 6, 'Department', 1, 0, 'C');
        $pdf->Cell(40, 6, 'Notes', 1, 0, 'C');
        $pdf->Cell(40, 6, 'Status', 1, 1, 'C');
        $pdf->SetFont('Arial', '', 10);

        $job_requests = $this->db->get('job_request')->result();
        $i = 1;
        foreach ($job_requests as $job) {
            $pdf->Cell(10, 6, $i++, 1, 0, 'C');
            $pdf->Cell(40, 6, $job->date, 1, 0);
            $pdf->Cell(50, 6, $job->job_title, 1, 0);
            $pdf->Cell(50, 6, $job->job_description, 1, 0);
            $pdf->Cell(40, 6, $job->department, 1, 0);
            $pdf->Cell(40, 6, $job->notes, 1, 0);
            $pdf->Cell(40, 6, $job->status, 1, 1);
        }

        $pdf->Output();
    }
}
