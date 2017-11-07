<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of PDFController
 *
 * @author Tomek
 */
class PDFController extends ControllerBase
{
    public function index() {
        $pdf = new PDFPlanRealizacji($this->args[0]);
        $pdf->AddFont('arial');
        $pdf->AddFont('arial', 'b');
        $pdf->AddFont('arial', 'i');
        $pdf->AddFont('arial', 'bi');
        $pdf->AliasNbPages();
        
        $pdf->FrontPage();
        $pdf->HistoriaZmian();
        $pdf->Gantt();
        
        $pdf->Output($pdf->project->name . '.pdf', 'I');
    }
    
    
}
