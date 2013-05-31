<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
require('fpdf.php');

class Pdf extends FPDF {

    private $columnSize = array();
    
    private $titleText = "";
    
    // Extend FPDF using this class
    // More at fpdf.org -> Tutorials

    function __construct($orientation = 'P', $unit = 'mm', $size = 'A4') {
        // Call parent constructor
        parent::__construct($orientation, $unit, $size);
    }

    function FancyTable($header, $data) {
        // Colors, line width and bold font
        $this->SetFillColor(59, 137, 255, 255);
        $this->SetTextColor(255);
        $this->SetDrawColor(128, 0, 0);
        $this->SetLineWidth(.3);

        // Header
        $w = $this->columnSize;
        for ($i = 0; $i < count($header); $i++){
            $this->Cell($w[$i], 7, $header[$i], 1, 0, 'C', true);
        }
        
        $this->Ln();
        
        // Color and font restoration
        $this->SetFillColor(224, 235, 255);
        $this->SetTextColor(0);
        $this->SetFont('');
        // Data
        $fill = false;

        $rowQtd = count($data);
        
        for ($i = 0; $i < $rowQtd; $i++) {
            
            $row = $data[$i];
            
            foreach ($row as $k => $value) {
                $this->Cell($w[$k], 10, $value, ($i < $rowQtd - 1 ? 'LR' : 'LRB'), 0, 'C', $fill);
            }
            
            $fill = !$fill;
            
        }
        
        $this->Ln();
    }
    
    /**
     * Used to set header size.
     * @param mixed $value Can use to set explicit index column size
     * like this: $pdf->setHeaderSize(1, 40);
     * or can use array to define all header columns 
     * like this: $pdf->setHeaderSize(array(20, 30, 17));
     * @param type $size
     */
    public function setColumnSize($value, $size = null){
        if(!is_array($value)){
            $this->columnSize[$value] = $size;
        } else {
            $this->columnSize = $value;
        }
    }
    
    // Page header
    function Header() {

        // Arial bold 15
        $this->SetFont('Arial', 'B', 15);
        // Move to the right
        $this->Cell(80);
        // Title
        $this->Cell(30, 10, $this->titleText, 0, 0, 'C');
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
    
    public function SetTitle($title) {
        parent::SetTitle($title, true);
        $this->titleText = $title;
    }
}

?>
