<?php 
$args = $this->args;
$report = null;

if (count($args) < 4) {
    $this->filename = 'raport-zbiorczy-cały';
    $report = new ConsReport2;
} else {
    $this->filename = "raport-zbiorczy-{$args[0]}-{$args[1]}" .
        ( ($args[0] == $args[2] && $args[1] == $args[3]) ? '' : "-{$args[2]}-{$args[3]}" );
    $report = new ConsReport2($this->args[0], $this->args[1], $this->args[2], $this->args[3]);
}

$sheet = $this->excel->getActiveSheet();

$rowOneLastColumn = 0;
$col = 0;
$row = 1;

++$col;
foreach($report->months as $month) {
    $sheet->cell($col++, $row, $month);
}

$row = 2;
foreach($report->projects as $project) {
    $col = 0;
    $sheet->cell($col++, $row, $project->name);

    foreach($report->months as $month) {
        $sheet->cell($col++, $row, $report->data[$project->id][$month]);
    }

    $sheet->cell($col, $row, $report->totals['project'][$project->id]);

    ++$row;
}

$col = 1;
foreach($report->totals['month'] as $value) {
    $sheet->cell($col++, $row, $value);
}

$sheet->cell($col, $row, $report->totals['total']);



$sheet->getColumnDimension('A')->setWidth(50);

$rowOneLastColumn = $sheet->getHighestColumn(1);
$lastColumn = $sheet->getHighestColumn();
$colOneLastRow = $sheet->getHighestRow('A');
$lastRow = $sheet->getHighestRow();

$sheet->getStyle("B1:{$rowOneLastColumn}1")
    ->applyFromArray($this->headerStyleArray);
$sheet->getStyle('A2:A' . $colOneLastRow)
    ->applyFromArray($this->headerStyleArray);
$sheet->getStyle("{$lastColumn}2:{$lastColumn}{$lastRow}")
    ->applyFromArray($this->headerStyleArray);
$sheet->getStyle("B{$lastRow}:{$lastColumn}{$lastRow}")
    ->applyFromArray($this->headerStyleArray);