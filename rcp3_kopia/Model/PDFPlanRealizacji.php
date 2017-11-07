<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of PDFPlanRealizacji
 *
 * @author Tomek
 */

function isHoliday($y, $m, $d)
{
    $hol=array('01-01', '01-06', '05-01','05-03','08-15','11-01','11-11','12-25','12-26'); 
    $dodatkowo_wolne = array('2014-11-10');
    $data = new \DateTime();
    $data->setDate($y, $m, $d);
    if (\in_array($data->format('Y-m-d'), $dodatkowo_wolne)) {
        return true;
    }
    $easter = \date('m-d', \easter_date($y));
    $date = \strtotime($y . '-' . $easter);  
    $easterSec = \date('m-d', \strtotime('+1 day', $date));  
    $cc = \date('m-d', \strtotime('+60 days', $date));  
    $hol[] = $easter;  
    $hol[] = $easterSec;  
    $hol[] = $cc; 
    $md = $data->format('m-d');
    $dw = $data->format('w');
    if (($dw == 0) || ($dw == 6) || \in_array($md, $hol)) {
        return true;
    }
    return false;
}

include 'Application' . DS . 'fpdf' . DS . 'fpdf.php';

class PDFPlanRealizacji extends FPDF
{   
    /* @var $project Project */
    public $project;
    public $events;
    public $tasks;
    public $dayZero;
    public $span;
    
    public $cellWidth = 8.0;
    public $cellHeight = 8.0;
    public $gridWidth = 25;
    public $barMargin = 1.0;

    public $gridStartTimeStamp;
    public $gridStartDate;
    public $gridStartMonthYear;
    
    public function __construct($projectId) {
        parent::__construct();
        $this->project = new Project();
        $this->project->loadById($projectId);
        $this->tasks = $this->project->getTasks();
        $eventsObject = new ProjectEvent;
        $this->events = $eventsObject->getWhere("project_id = {$this->project->id}");
        $this->span = floor(($this->project->endTimeStamp - $this->project->beginTimeStamp) / (60*60*24)) + 1;
        if ($this->span + 2 > $this->gridWidth) {
            $this->gridWidth = $this->span + 2;
            $this->cellWidth = 200.0 / (float)($this->gridWidth);
        }
        $this->dayZero = floor(($this->gridWidth - $this->span) / 2);
        $this->gridStartTimeStamp = strtotime("{$this->project->begin} - {$this->dayZero} days");
    }
    
    public function Header()
    {
        $this->SetFont('arial', 'b', 20);
        $this->Image('Includes' . DS . 'kpgeo.png', null, null, 60);
        $this->SetXY(10, 10);
        $this->Cell(60, 20.25, '', 1);
        $this->SetFontSize(12);
        $this->Cell(80, 20.25, 'Plan realizacji usługi', 1, 0, 'C');
        $this->SetFontSize(11);
        $this->Cell(50, 7.25, 'F 01.01.01', 1, 2, 'C');
        $this->MultiCell(50, 6.5, "Data wyd.\n" . date('d.m.y'), 1, 'C');
        $this->Cell(0, 10, '', 0, 1);
    }
    
    public function Footer() {
        $this->SetXY(10, -15);
        $this->SetFont('arial', 'i', 10);
        $this->Cell(190, 5, 'Strona' . $this->PageNo() . '/{nb}', 'T', 0, 'R');
    }
    
    public function Space() {
        $this->Cell(0, 10, '', 0, 1);
    }

    public function FrontPage() {
        $this->AddPage();
        $this->SetFont('arial', 'b', 18);
        $this->Cell(190, 20, 'PLAN REALIZACJI USŁUGI', 0, 1, 'C');
        $this->Space();
        $this->SetFontSize(14);
        $this->Cell(60, 10, 'Projekt:', 0, 0);
        $this->Cell(130, 10, $this->project->name, 0, 1);
        $this->Cell(60, 10, 'Klient:', 0, 0);
        $this->Cell(130, 10, $this->project->client, 0, 1);
        $this->Cell(60, 10, 'Nr zlecenia/Nr umowy:', 0, 0);
        $this->Cell(130, 10, $this->project->orderNumber, 0, 1);
        $this->Cell(60, 10, 'Kierownik projektu:', 0, 0);
        $this->Cell(130, 10, $this->project->projectManager->getFullName(), 0, 1);
        $this->Cell(60, 10, 'Data utworzenia:', 0, 0);
        $this->Cell(130, 10, date('d.m.y', strtotime($this->project->begin)), 0, 1);
    }
    
    public function HistoriaZmian() {
        $this->AddPage();
        $this->SetFont('arial', 'b', 16);
        $this->Cell(190, 10, 'Historia zmian', 0, 1);
        $this->Space();
        $this->SetFont('arial', 'b', 12);
        $this->SetFillColor(0xde, 0xde, 0xde);
        $this->Cell(50, 7, 'Osoba', 1, 0, 'C', 1);
        $this->Cell(60, 7, 'Zmiana', 1, 0, 'C', 1);
        $this->Cell(30, 7, 'Data', 1, 0, 'C', 1);
        $this->Cell(50, 7, 'Zatwierdził', 1, 1, 'C', 1);
        $this->SetFont('arial', '', 11);
        foreach($this->events as $event) {
            $this->Cell(50, 7, $event->getUser()->getFullName(), 1, 0, 'C');
            $this->Cell(60, 7, $event->event, 1, 0, 'C');
            $this->Cell(30, 7, date('j.m.Y', $event->time), 1, 0, 'C');
            $acceptedBy = $event->getAccepts();
            $this->Cell(50, 7, $acceptedBy ? $acceptedBy->getFullName() : '', 1, 1, 'C');
        }
    }
    
    public function Gantt() {
        $this->AddPage('L');
        $this->SetFont('arial', 'b', 16);
        $this->Cell(190, 10, 'Plan realizacji', 0, 1);
        
        
        $this->SetFont('arial', '', 9);
        $this->Space();
        
        $this->Cell(77);
        
        $pula = $this->gridWidth;
        $curDate = $this->gridStartTimeStamp;
        $monthNames = array( 1 =>
                'Styczeń', 'Luty', 'Marzec', 'Kwiecień', 'Maj', 'Czerwiec',
                'Lipiec', 'Sierpień', 'Wrzesień', 'Październik', 'Listopad', 'Grudzień'
            );
        while($pula > 0) {
            $colspan = min(array($pula, cal_days_in_month(1, date('n', $curDate), date('Y', $curDate)) - date('j', $curDate) + 1));
            $monthString = $monthNames[date('n', $curDate)] . ' ' . date('Y',$curDate);
            if ($this->GetStringWidth($monthString) + $this->cellWidth > $this->cellWidth * $colspan) {
                $monthString = '';
            }
            $this->Cell($this->cellWidth * $colspan, 6, $monthString, 1, 0, 'C');
            $curDate = strtotime("+ $colspan days", $curDate);
            $pula -= $colspan;
        }
        
        $this->Ln();
        
        $holidays = array();
        if ($this->cellWidth > 4) {
            $this->Cell(77);
            $this->SetFillColor(240, 240, 240);
            for($i = 0; $i < $this->gridWidth; ++$i) {
                $thisTime = strtotime("+ $i days", $this->gridStartTimeStamp);
                $holidays[$i] = isHoliday(date('Y', $thisTime), date('n', $thisTime), date('j', $thisTime));
                $this->Cell($this->cellWidth, 6, date('j', $thisTime), 1, 0, 'C', $holidays[$i]);
            }
            $this->Ln();
        } else {
            for($i = 0; $i < $this->gridWidth; ++$i) {
                $thisTime = strtotime("+ $i days", $this->gridStartTimeStamp);
                $holidays[$i] = isHoliday(date('Y', $thisTime), date('n', $thisTime), date('j', $thisTime));
            }
        }
        
        foreach($this->tasks as $task) {
            $this->Cell(57, $this->cellHeight, $task->name, 1, 0, 'C');
            $this->Cell(20, $this->cellHeight / 2, date('d.m.Y', $task->begin), 'LTR', 2, 'C');
            $this->Cell(20, $this->cellHeight / 2, date('d.m.Y', $task->end), 'LBR', 0, 'C');
            $this->SetXY($this->GetX(), $this->GetY() - $this->cellHeight / 2);
            $x = $this->GetX();
            $y = $this->GetY();
            if ($this->cellWidth > 0) {
                $this->SetFillColor(240, 240, 240);
                for($i = 0; $i < $this->gridWidth; ++$i) {
                    $this->Cell($this->cellWidth, $this->cellHeight, '', ($this->cellWidth > 3) ? 1 : 'TB', 0, '', $holidays[$i]);
                }
                $this->Cell(0,$this->cellHeight, '', 'L');
            }
            
            $startCell = $this->dayZero;
            $numCells = $this->span;
            if ($task->begin && $task->end) {
                $startCell += floor(($task->begin - $this->project->beginTimeStamp) / (60*60*24));
                $numCells = floor(($task->end - $task->begin) / (60*60*24)) + 1;
            }
            
            //$this->SetFillColor(0xde, 0xde, 0xde);
            //$this->SetFillColor(39, 26, 69);
            $this->SetFillColor(56, 114, 63);
            $this->SetXY($x + $this->cellWidth * $startCell + $this->barMargin, $y + $this->barMargin);
            $this->Cell($this->cellWidth * $numCells - 2.0 * $this->barMargin, $this->cellHeight - 2.0 * $this->barMargin, '', 1, 0, '', true);
            $this->Ln($this->cellHeight - $this->barMargin);
        }
        
    }
}
