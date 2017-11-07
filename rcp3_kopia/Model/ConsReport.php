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
class ConsReport extends ActiveRecord
{
    public $year;
    public $projects = array();
    public $totals = array();
    
    /**
     * Array projectId => array(month => total h)
     * @var type 
     */
    public $data = array();
    
    public function __construct($year) {
        $this->year = $year;
        $projectObject = new Project;
        
        $this->projects = $projectObject->getWhere("TRUE ORDER BY nazwa ASC");
        
        foreach ($this->projects as $project) {
            $this->data[$project->id] = array();
            for ($month = 1; $month <= 12; ++$month) {
                $this->data[$project->id][$month] = 0;
                $query =
                    "SELECT TIMESTAMPDIFF(SECOND, ut.start, ut.stop) FROM user_tasks ut, tasks ta
                    WHERE ut.task_id = ta.id
                    AND ta.project_id = {$project->id}
                    AND YEAR(ut.start) = {$year}
                    AND MONTH(ut.start) = {$month}";
                $res = self::$_mysqli->query($query);
                while ($row = $res->fetch_row()) {
                    $this->data[$project->id][$month] += $row[0] / 28800.;
                }
            }
        }
        
        for ($month = 1; $month <= 12; ++$month) {
            $this->totals[$month] = 0;
            foreach ($this->data as $projectId => $months) {
                $this->totals[$month] += $this->data[$projectId][$month];
            }
        }
    }
    
}
