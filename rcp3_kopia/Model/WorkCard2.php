<?php
error_reporting(E_ALL ^ E_NOTICE);
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of WorkCard2
 *
 * @author Tomek
 */
class WorkCard2 extends ActiveRecord {
    
    public $users = array();
    
    public $projects = array();
    public $project3Tasks = array();
    
    private $data = array();
    private $project3Data = array();
    
    
    public $leftTableContent = array();
    public $rightTableContent = array();
    
    public $verticalTotals = array();
    public $leftHorizontalTotals = array();
    public $rightHorizontalTotals = array();
    public $totalsTotals = 0;
    
    public $fromDateTime;
    public $toDateTime;
    
    public $yearFrom;
    public $monthFrom;
    public $dayFrom;
    public $yearTo;
    public $monthTo;
    public $dayTo;
    
    /**
     * 
     * @param int $yearFrom
     * @param int $monthFrom
     * @param int $dayFrom
     * @param int $yearTo
     * @param int $monthTo
     * @param int $dayTo
     */
    public function __construct($yearFrom = null, $monthFrom = null, $dayFrom = null, $yearTo = null, $monthTo = null,  $dayTo = null) {
        
        if (!($yearFrom && $monthFrom && $yearTo && $monthTo && $dayFrom && $dayTo)) {
            $yearFrom = $yearTo = \date('Y');
            $monthFrom = $monthTo = \date('n');
            $dayFrom = $dayTo = \date('d');
        }
        
        $this->yearFrom = $yearFrom;
        $this->monthFrom = $monthFrom;
        $this->dayFrom = $dayFrom;
        $this->yearTo = $yearTo;
        $this->monthTo = $monthTo;
        $this->dayTo = $dayTo;
        
        $this->fromDateTime = date(DATE_FORMAT_MYSQL, mktime(0, 0, 0,  $monthFrom, $dayFrom, $yearFrom));
        $this->toDateTime = date(DATE_FORMAT_MYSQL, mktime(23, 59, 59, $monthTo,   $dayTo,   $yearTo));
       


        $usersQuery =
            "SELECT
                us.id as id,
                CONCAT(us.imie, ' ', us.nazwisko) as name
            FROM
                user_tasks ut,
                users us
            WHERE
                ut.user_id = us.id
                AND ut.start >= '{$this->fromDateTime}'
                AND ut.start <= '{$this->toDateTime}'
            GROUP BY
                ut.user_id
            ORDER BY
                us.nazwisko,
                us.imie";
        
        $projectsQuery = 
            "SELECT
                pr.id as id,
                pr.nazwa as name
            FROM
                user_tasks ut,
                tasks ta,
                projects pr
            WHERE
                ut.task_id = ta.id
                AND ta.project_id != 3
                AND ta.project_id = pr.id
                AND ut.start >= '{$this->fromDateTime}'
                AND ut.start <= '{$this->toDateTime}'
            GROUP BY
                pr.id
            ORDER BY
                pr.nazwa";
                
        $dataQuery =
            "SELECT
                ut.user_id,
                ta.project_id,
                SUM(TIMESTAMPDIFF(MINUTE, ut.start, ut.stop)/60)
            FROM
                user_tasks ut,
                tasks ta
            WHERE
                ut.task_id = ta.id
                AND ta.project_id != 3
                AND ut.start >= '{$this->fromDateTime}'
                AND ut.start <= '{$this->toDateTime}'
            GROUP BY
                ut.user_id,
                ta.project_id";
        
        $project3TasksQuery = 
            "SELECT 
                ta.id as id,
                ta.nazwa as name
            FROM tasks ta, user_tasks ut
            WHERE
                ut.task_id = ta.id
                AND ta.project_id = 3
                AND ut.start >= '{$this->fromDateTime}'
                AND ut.start <= '{$this->toDateTime}'
            GROUP BY ta.id
                ";
        
        $project3DataQuery =
            "SELECT
                ut.user_id,
                ut.task_id,
                SUM(TIMESTAMPDIFF(MINUTE, ut.start, ut.stop)/60)
            FROM
                user_tasks ut,
                tasks ta
            WHERE
                ut.task_id = ta.id
                AND ta.project_id = 3
                AND ut.start >= '{$this->fromDateTime}'
                AND ut.start <= '{$this->toDateTime}'
            GROUP BY
                ut.user_id,
                ta.id";
                
        
        
        /* @var $usersRes mysqli_result */
        $usersRes = self::$_mysqli->query($usersQuery);
        $projectsRes = self::$_mysqli->query($projectsQuery);
        $dataRes = self::$_mysqli->query($dataQuery);
        $project3TasksRes = self::$_mysqli->query($project3TasksQuery);
        $project3DataRes = self::$_mysqli->query($project3DataQuery);
        while ($row = $usersRes->fetch_assoc()) {
            $this->users[] = $row;
        }
        
        while ($row = $projectsRes->fetch_assoc()) {
            $this->projects[] = $row;
        }
        
        while ($row = $dataRes->fetch_row()) {
            $this->data[$row[0]][$row[1]] = (float)$row[2];
        }
        
        while ($row = $project3TasksRes->fetch_assoc()) {
            $this->project3Tasks[] = $row;
        }
        
        while ($row = $project3DataRes->fetch_row()) {
            $this->project3Data[$row[0]][$row[1]] = (float)$row[2];
        }
        
        for ($i = 0; $i < count($this->users); ++$i) {
            
            $this->verticalTotals[$i] = 0;
            $this->leftTableContent[$i] = array();
            
            for ($j = 0; $j < count($this->projects); ++$j) {
                if (!$i) {
                    $this->leftHorizontalTotals[$j] = 0;
                }
                
                $val = $this->data[$this->users[$i]['id']][$this->projects[$j]['id']];

                $this->verticalTotals[$i] += $val;
                $this->leftHorizontalTotals[$j] += $val;
                $this->leftTableContent[$i][$j] = $val;
                  
            }
            
            $this->rightTableContent[$i] = array();
            
            for ($j = 0; $j < count($this->project3Tasks); ++$j) {
                if (!$i) {
                    $this->rightHorizontalTotals[$j] = 0;
                }
                $val = $this->project3Data[$this->users[$i]['id']][$this->project3Tasks[$j]['id']];

                $this->verticalTotals[$i] += $val;
                $this->rightHorizontalTotals[$j] += $val;
                $this->rightTableContent[$i][$j] = $val;
                    
            }
            
            $this->totalsTotals += $this->verticalTotals[$i];


        }

    }
}