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
            $fill = false;
            
            foreach ($data as $row) {
                $this->Cell($w[0], 6, "aborba", 'LR', 0, 'L', $fill);
                $this->Cell($w[1], 6, $row[1], 'LR', 0, 'L', $fill);
                $this->Cell($w[2], 6, $row[2], 'LR', 0, 'R', $fill);
                $this->Ln();
                $fill = !$fill;
            }
            
            // Closing line
            $this->Cell(array_sum($w), 0, '', 'T');
        }

}

?>
