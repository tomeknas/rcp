<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ExcelController
 *
 * @author Tomek
 */
class ExcelController extends ControllerBase {
    
    /**
     *
     * @var PHPExcel
     */
    private $excel = null;
    
    /**
     *
     * @var PHPExcel_Writer_Abstract|PHPExcel_Writer_IWriter
     */
    private $writer = null;
    
    private $pdf = false;
    
    private $filename = 'a';
    
    private $headerStyleArray;
    
    public function __construct($args = array()) {
        parent::__construct($args);
        define('PHPEXCEL_ROOT', SITE_PATH . DS . 'Application' . DS);
        include 'Application' . DS . 'PHPExcel.php';
        
        $this->excel = new PHPExcel;
        $this->headerStyleArray = [
            'fill' => [
                'type' => PHPExcel_Style_Fill::FILL_SOLID,
                'startcolor' => [
                    'argb' => 'FFDEDEDE'
                ]
            ],
            'font' => [
                'bold' => true
            ]
        ];
        
    }
    
    public function __destruct() {
        header('Content-type: application/' . ($this->pdf ? 'pdf' : 'vnd.ms-excel') );
        header("Content-Disposition: attachment; filename=\"{$this->filename}." . ( $this->pdf ?  "pdf\"" : "xls" ) );
        
        if($this->pdf) {
            PHPExcel_Settings::setPdfRenderer(
                    PHPExcel_Settings::PDF_RENDERER_DOMPDF,
                    SITE_PATH . DS . 'Application' . DS . 'dompdf-0.6.1'
                );
        }
        
        $this->writer = PHPExcel_IOFactory::createWriter($this->excel, $this->pdf ? 'PDF' : 'Excel5');
        
        if($this->pdf) {
            $this->writer->setSheetIndex(0);
        }
        
        $this->writer->save('php://output');
    }
    
    public function index() {}
    
    public function workCard()
    {
        include 'Views/Excel/workCard.php';
    }
    
    public function consReport()
    {
        include 'Views/Excel/consReport.php';
    }
    
    public function workCardPdf()
    {
        $this->pdf = true;
        $this->workCard();
    }
    
    public function consReportPdf()
    {
        $this->pdf = true;
        include 'Views/Excel/consReport.php';
    }
}
