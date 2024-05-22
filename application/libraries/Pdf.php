<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH . 'third_party/fpdf/fpdf.php';

class Pdf extends FPDF {
    public function __construct() {
        parent::__construct();
    }

    // Custom Header
    function Header() {
        // Logo
        $this->Image(base_url('assets/dist/img/logoglopac.png'), 10, 6, 30); // Path to logo file, position x=10, y=6, width=30mm
        // Arial bold 15
        $this->SetFont('Arial', 'B', 15);
        // Title
        $this->Cell(0, 10, 'PT Glopac Indonesia', 0, 1, 'C');
        $this->SetFont('Arial', 'I', 12);
        $this->Cell(0, 10, 'Jl. Jati 5 blok J4 No. 3, Newton Techno Park, Lippo Cikarang, Bekasi, Jawa Barat, Indonesia.', 0, 1, 'C');
        $this->Cell(0, 10, 'T : +6221 8990 8169, F : +6221 8990 2247', 0, 1, 'C');
        
        // Add a line break
        $this->Ln(5);

        // Draw the line
        $this->Cell(0, 0, '', 'T', 1, 'C');

        // Move to the right
        $this->Ln(5);
        // JOB REQUEST title
        $this->SetFont('Arial', 'B', 14);
        $this->Cell(0, 10, 'JOB REQUEST', 0, 1, 'C');
        // Line break
        $this->Ln(10);
    }

    // Custom Footer
    function Footer() {
        // Position at 1.5 cm from bottom
        $this->SetY(-15);
        // Arial italic 8
        $this->SetFont('Arial', 'I', 8);
        // Page number
        $this->Cell(0, 10, 'Page '.$this->PageNo().'/{nb}', 0, 0, 'C');
    }
}
