<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
require('fpdf.php');

class Pdf extends FPDF {

    // Extend FPDF using this class
    // More at fpdf.org -> Tutorials

    function __construct($orientation = 'P', $unit = 'mm', $size = 'A4') {
        // Call parent constructor
        parent::__construct($orientation, $unit, $size);
    }

    function FancyTable($header, $data) {
        // Colors, line width and bold font
        $this->SetFillColor(255, 0, 0);
        $this->SetTextColor(255);
        $this->SetDrawColor(128, 0, 0);
        $this->SetLineWidth(.3);

        // Header
        $w = array(40, 35, 40, 45);
        for ($i = 0; $i < count($header); $i++)
            $this->Cell($w[$i], 7, $header[$i], 1, 0, 'C', true);
        $this->Ln();
        // Color and font restoration
        $this->SetFillColor(224, 235, 255);
        $this->SetTextColor(0);
        $this->SetFont('');
        // Data
        $this->Ln();
        $fill = false;

        foreach ($data as $row) {
            foreach ($row as $k => $value) {
                $this->Cell(40, 10, $value, 'LR', 0, 'L', $fill);
            }
            $fill = !$fill;
        }

        // Closing line
        $this->Cell(array_sum($w), 0, '', 'T');
    }

// Page header
    function Header() {

        // Arial bold 15
        $this->SetFont('Arial', 'B', 15);
        // Move to the right
        $this->Cell(80);
        // Title
        $this->Cell(30, 10, 'Title', 1, 0, 'C');
        // Line break
        $this->Ln(20);
    }

// Page footer
    function Footer() {
        // Position at 1.5 cm from bottom
        $this->SetY(-15);
        // Arial italic 8
        $this->SetFont('Arial', 'I', 8);
        // Page number
        $this->Cell(0, 10, 'Page ' . $this->PageNo() . '/{nb}', 0, 0, 'C');
    }

}

?>
