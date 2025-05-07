<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Laporanpdf extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('Pdf'); // Memanggil library yang kita buat tadi
        $this->load->model('job_request_model'); // Load model untuk mengambil data detail job request
    }

    public function index()
    {
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

        // Fetching data from database with filters
        $post = $this->input->post();
        $dateFrom = isset($post['dateFrom']) ? $post['dateFrom'] : '';
        $dateTo = isset($post['dateTo']) ? $post['dateTo'] : '';

        if (!empty($dateFrom) || !empty($dateTo)) {
            // Jika ada filter yang diterapkan, gunakan filter tersebut
            $job_request = $this->job_request_model->get_filtered_data($dateFrom, $dateTo);
        } else {
            // Jika tidak ada filter, ambil semua data
            $job_request = $this->db->get('job_request')->result();
        }

        $i = 1;
        foreach ($job_request as $job) {
            // Tentukan tinggi maksimum dari setiap kolom dalam satu baris
            $titleHeight = $pdf->GetMultiCellHeight(35, 5, $job->job_title);
            $descHeight = $pdf->GetMultiCellHeight(72, 5, $job->job_description);
            $deptHeight = $pdf->GetMultiCellHeight(25, 5, $job->department);
            $notesHeight = $pdf->GetMultiCellHeight(12, 5, $job->notes);
            $maxHeight = max($titleHeight, $descHeight, $deptHeight, $notesHeight, 5);

            // Cetak setiap sel
            $pdf->Cell(8, $maxHeight, $i++, 1, 0, 'C');
            $pdf->Cell(18, $maxHeight, $job->date, 1, 0, 'C');

            // Job Title
            $x = $pdf->GetX();
            $y = $pdf->GetY();
            $pdf->MultiCell(35, $maxHeight, $job->job_title, 1);
            $pdf->SetXY($x + 35, $y);

            // Job Description
            $x = $pdf->GetX();
            $y = $pdf->GetY();
            $pdf->MultiCell(72, $maxHeight, $job->job_description, 1);
            $pdf->SetXY($x + 72, $y);

            // Department
            $x = $pdf->GetX();
            $y = $pdf->GetY();
            $pdf->MultiCell(25, $maxHeight, $job->department, 1);
            $pdf->SetXY($x + 25, $y);

            // Notes
            $x = $pdf->GetX();
            $y = $pdf->GetY();
            $pdf->MultiCell(12, 5, $job->notes, 1);
            $pdf->SetXY($x + 12, $y);

            // Status
            $pdf->Cell(20, $maxHeight, $job->status, 1, 1, 'C');
        }

        $pdf->Output();

    }
}
