<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pdf_c extends CI_Controller {
    public $pdf;
    public $i = 1;

    function __construct(){
        parent::__construct();
        $this->load->library('Pdf'); // Memanggil library yang kita buat
        $this->load->database('');
        $this->load->helper('url');
        $this->load->model('Pdf_model');
        $this->pdf = new FPDF();
        $this->pdf = new FPDF('L', 'mm', 'A4');
    }

    function index()
    {
        $pdf = new FPDF();

        $pdf->AddPage();
        $pdf->SetFont('Arial', 'B', 16);
        $pdf->Cell(190, 7, 'Job Request', 0, 1, 'C');
        $pdf->Cell(10, 7, '', 0, 1); // Spasi kosong untuk pemisah
        
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(10, 6, 'No', 1, 0, 'C');
        $pdf->Cell(20, 6, 'Date', 1, 0, 'C');
        $pdf->Cell(50, 6, 'Job Title', 1, 0, 'C');
        $pdf->Cell(70, 6, 'Job Description', 1, 0, 'C');
        $pdf->Cell(30, 6, 'Department', 1, 0, 'C');
        $pdf->Cell(50, 6, 'Notes', 1, 0, 'C');
        $pdf->Cell(20, 6, 'Image', 1, 0, 'C');
        $pdf->Cell(20, 6, 'Status', 1, 1, 'C');
        $pdf->SetFont('Arial', '', 10);
        
        // Fetch job requests from database
        $job_request = $this->Pdf_model->get_data();

        print_r($job_request);
        die;

        $no = 1;
        foreach ($job_request as $data) {
            $pdf->Cell(10, 6, $no, 1, 0, 'C');
            $pdf->Cell(20, 6, $data->date, 1, 0);
            $pdf->Cell(50, 6, $data->job_title, 1, 0);
            $pdf->Cell(70, 6, $data->job_description, 1, 0);
            $pdf->Cell(30, 6, $data->department, 1, 0);
            $pdf->Cell(50, 6, $data->notes, 1, 0);
            $pdf->Cell(20, 6, $data->image, 1, 0);
            $pdf->Cell(20, 6, $data->status, 1, 1);
            $no++;
        }

        $pdf->Output();
    }
}
