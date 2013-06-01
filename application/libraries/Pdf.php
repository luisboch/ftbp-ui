<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
require('fpdf.php');

class Pdf extends FPDF {

    private $logger;
    
    private $columnSize = array();
    
    private $titleText = "";
    
    function __construct($orientation = 'P', $unit = 'mm', $size = 'A4') {
        // Call parent constructor
        parent::__construct($orientation, $unit, $size);
        
        $this->logger = Logger::getLogger(__CLASS__);
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
        $this->SetFillColor(215, 215, 215, 255);
        $this->SetTextColor(0);
        $this->SetFont('');
        
        // Data
        $fill = false;

        $rowQtd = count($data);
        
        // Print data
        for ($i = 0; $i < $rowQtd; $i++) {
            
            $row = $data[$i];
            
            foreach ($row as $k => $value) {
                $this->Cell($w[$k], 7, $this->utf8ToUtf16($value), ($i < $rowQtd - 1 ? 'LR' : 'LRB'), 0, 'C', $fill);
            }
            
            // Swap background color
            $fill = !$fill;
            
            $this->Ln(7);
            
        }
        
        $this->Ln(6);
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
        
        // Title
        $this->Cell(190, 10, $this->titleText, 1, 0, 'C');
        // Line break
        $this->Ln(12);
    }

    // Page footer
    function Footer() {
        // Position at 1.5 cm from bottom
        $this->SetY(-15);
        // Arial italic 8
        $this->SetFont('Arial', 'I', 8);
        // Page number
        $this->Cell(0, 10, 'Page ' . $this->PageNo() , 0, 0, 'C');
    }
    
    public function SetTitle($title) {
        parent::SetTitle($title, true);
        $this->titleText = $this->utf8ToUtf16($title);
    }
    public function utf8ToUtf16($text) {
        $this->logger->debug("Before decode: ".$text);
        $text = substr(iconv('UTF8', 'UTF16', $text), 2);
        $this->logger->debug("After decode: ".$text);
        return $text;
    }
}

?>
