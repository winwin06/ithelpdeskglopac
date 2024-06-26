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
        $this->Image(base_url('assets/dist/img/logoglopac.png'), 10, 12, 20); // Path to logo file, position x=10, y=6, width=30mm
        // Arial bold 15
        $this->SetFont('Arial', 'B', 12);
        // Move to the right
        $this->Cell(8);
        // Title
        $this->Cell(0, 7, 'PT Glopac Indonesia', 0, 1, 'C');
        $this->SetFont('Arial', 'I', 8);
        $this->Cell(0, 4, 'Jl. Jati 5 blok J4 No. 3, Newton Techno Park, Lippo Cikarang, Bekasi, Jawa Barat, Indonesia.', 0, 1, 'C');
        $this->Cell(0, 4, 'T : +6221 8990 8169, F : +6221 8990 2247', 0, 1, 'C');
        
        // Add a line break
        $this->Ln(4);

        // Draw the line
        $this->Cell(0, 0, '', 'T', 1, 'C');

        // Move to the right
        $this->Ln(4);
        // JOB REQUEST title
        $this->SetFont('Arial', '', 14);
        $this->Cell(0, 5, 'JOB REQUEST', 0, 1, 'C');
        // Line break
        $this->Ln(5);
    }

    // Custom Footer
    function Footer() {
        // Posisi 1.5 cm dari bawah
        $this->SetY(-15);
        // Arial italic 8
        $this->SetFont('Arial', 'I', 8);
        // Nomor halaman
        $this->Cell(0, 10, 'Page '.$this->PageNo().'/{nb}', 0, 0, 'C');
    }

    // Extend FPDF class and add a new method to calculate the height of MultiCell
    function GetMultiCellHeight($w, $h, $txt)
    {
        // Compute the number of lines needed to display the text
        $cw = &$this->CurrentFont['cw'];
        if ($w == 0) {
            $w = $this->w - $this->rMargin - $this->x;
        }
        $wmax = ($w - 2 * $this->cMargin) * 1000 / $this->FontSize;
        $s = str_replace("\r", '', $txt);
        $nb = strlen($s);
        if ($nb > 0 and $s[$nb - 1] == "\n") {
            $nb--;
        }
        $sep = -1;
        $i = 0;
        $j = 0;
        $l = 0;
        $ns = 0;
        $height = 0;
        while ($i < $nb) {
            $c = $s[$i];
            if ($c == "\n") {
                $height += $h;
                $i++;
                $sep = -1;
                $j = $i;
                $l = 0;
                $ns = 0;
                continue;
            }
            if ($c == ' ') {
                $sep = $i;
                $ls = $l;
                $ns++;
            }
            $l += $cw[$c];
            if ($l > $wmax) {
                if ($sep == -1) {
                    if ($i == $j) {
                        $i++;
                    }
                } else {
                    $i = $sep + 1;
                }
                $sep = -1;
                $j = $i;
                $l = 0;
                $ns = 0;
                $height += $h;
            } else {
                $i++;
            }
        }
        $height += $h;
        return $height;
    }
}
