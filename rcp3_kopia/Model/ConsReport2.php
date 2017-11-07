<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ConsReport
 *
 * @author Tomek
 */
class ConsReport2 extends ActiveRecord
{
    public $months = array();
    public $projects = array();
    public $totals = ['month' => [], 'project' => [], 'total' => 0];
    public $allTime = false;
    public $period = [];
    public static $interval = 'month';
    /**
     * Array projectId => array(month => total h)
     * @var type 
     */
    public $data = array();
    
    public static function setInterval ($interval) {
        if (empty($interval)) {
            return false;
        }
        self::$interval = $interval;
    }
    
    public function __construct($yearFrom = 0, $monthFrom = 0, $yearTo = 0, $monthTo = 0)
    {   
        switch(self::$interval) {
            case 'month':
                $modeString = "DATE_FORMAT(ut.start, '%Y-%m')";
                break;
            case 'quarter':
                $monthFrom = (int)(($monthFrom - 1) / 3) * 3 + 1;
                $monthTo = (int)(($monthTo - 1) / 3) * 3 + 3;
                $modeString = "CONCAT(YEAR(ut.start), ' : ', QUARTER(ut.start))";
                break;
        }
        
        $this->period = [
            'from' => [
                'year' => $yearFrom,
                'month' => $monthFrom,
                'dateTime' => $yearFrom.'-'.$monthFrom.'-01'
            ],
            'to' => [
                'year' => $yearTo,
                'month' => $monthTo,
                'dateTime' => $yearTo.'-'.$monthTo.'-01'
            ]
        ];
        
        $this->allTime = !($yearFrom && $monthFrom && $yearTo && $monthTo);
        /* @var $mysqli mysqli */
        $mysqli = self::$_mysqli;
        
        if (!$this->allTime) {
            $startTime = "{$yearFrom}-{$monthFrom}-1";
            $stopTime = "{$yearTo}-{$monthTo}-" . cal_days_in_month(1, $monthTo, $yearTo) . ' 23:59:59';
            $mysqli->query("SET @starttime = '{$startTime}'");
            $mysqli->query("SET @stoptime = '{$stopTime}'");
        }
        
        $query = "
            SELECT
                {$modeString}
                    as month,
                pr.id
                    as project_id,
                sum(timestampdiff(minute, ut.start, ut.stop)) / 480
                    as total
            FROM projects pr
            JOIN tasks ta
                ON ta.project_id = pr.id
            JOIN user_tasks ut
                ON ta.id = ut.task_id"
        
         .  ($this->allTime ? '' : "
            WHERE ut.start >= @starttime
            AND ut.start <= @stoptime")
        
         . "
            GROUP BY month, pr.id
            ORDER BY month";
        /* @var $result mysqli_result */
        $result = $mysqli->query($query);
        
        $projectObject = new Project;
        $projectIds = array();
        
        while ($row = $result->fetch_assoc()) {
            if (!in_array($row['month'], $this->months)) {
                $this->months[] = $row['month'];
                $this->totals['month'][$row['month']] = 0.;
            }
            if (!in_array($row['project_id'], $projectIds)) {
                $projectIds[] =  $row['project_id'];
                $this->totals['project'][$row['project_id']] = 0.;
            }
            $val = $this->data[$row['project_id']][$row['month']] = (float)$row['total'];
            $this->totals['month'][$row['month']] += $val;
            $this->totals['project'][$row['project_id']] += $val;
            $this->totals['total'] += $val;
        }
        
        if (!empty($projectIds)) {
            $projectIdsString = implode(',', $projectIds);
            $this->projects = $projectObject->getWhere("id IN ({$projectIdsString}) ORDER BY nazwa");
        }
    }
        
}
