<?php 
$args = $this->args;
$this->filename = "karta-pracy-{$args[0]}-{$args[1]}" .
            ( ($args[0] == $args[2] && $args[1] == $args[3]) ? '' : "-{$args[2]}-{$args[3]}" );
$sheet = $this->excel->getActiveSheet();
$report = new WorkCard2($this->args[0], $this->args[1], $this->args[2], $this->args[3]);
$rowOneLastColumn = 0;
$col = 0;
$row = 1;

++$col;
foreach($report->projects as $project) {
    $sheet->cell($col++, $row, $project['name']);
}

foreach($report->project3Tasks as $project3Task) {
    $sheet->cell($col++, $row, $project3Task['name']);
}

$row = 2;
foreach($report->users as $user) {
    $col = 0;
    $sheet->cell($col++, $row, $user['name']);

    foreach($report->leftTableContent[$row-2] as $value) {
        $sheet->cell($col++, $row, $value);
    }

    foreach($report->rightTableContent[$row-2] as $value) {
        $sheet->cell($col++, $row, $value);
    }

    $sheet->cell($col, $row, $report->verticalTotals[$row-2]);

    ++$row;
}

$col = 1;
foreach($report->leftHorizontalTotals as $value) {
    $sheet->cell($col++, $row, $value);
}
foreach($report->rightHorizontalTotals as $value) {
    $sheet->cell($col++, $row, $value);
}
$sheet->cell($col, $row, $report->totalsTotals);

$sheet->getColumnDimension('A')->setWidth(25);

$rowOneLastColumn = $sheet->getHighestColumn(1);
$lastColumn = $sheet->getHighestColumn();
$colOneLastRow = $sheet->getHighestRow('A');
$lastRow = $sheet->getHighestRow();

$sheet->getStyle("B1:{$rowOneLastColumn}1")
    ->getAlignment()->setTextRotation(45);
$sheet->getStyle("B1:{$rowOneLastColumn}1")
    ->applyFromArray($this->headerStyleArray);
$sheet->getStyle('A2:A' . $colOneLastRow)
    ->applyFromArray($this->headerStyleArray);
$sheet->getStyle("{$lastColumn}2:{$lastColumn}{$lastRow}")
    ->applyFromArray($this->headerStyleArray);
$sheet->getStyle("B{$lastRow}:{$lastColumn}{$lastRow}")
    ->applyFromArray($this->headerStyleArray);